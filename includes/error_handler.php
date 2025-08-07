<?php
/**
 * Enhanced Error Handling and Logging System
 * Provides comprehensive error handling, logging, and monitoring capabilities
 */

class ErrorHandler {
    private static $logFile = __DIR__ . '/../logs/error.log';
    private static $maxLogSize = 10485760; // 10MB
    
    /**
     * Initialize error handler
     */
    public static function init() {
        // Create logs directory if it doesn't exist
        $logDir = dirname(self::$logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        // Set custom error and exception handlers
        set_error_handler([self::class, 'handleError']);
        set_exception_handler([self::class, 'handleException']);
        register_shutdown_function([self::class, 'handleFatalError']);
    }
    
    /**
     * Handle PHP errors
     * @param int $severity Error severity
     * @param string $message Error message
     * @param string $filename File where error occurred
     * @param int $line Line number where error occurred
     * @return bool
     */
    public static function handleError($severity, $message, $filename, $line) {
        // Don't handle errors if error reporting is turned off
        if (!(error_reporting() & $severity)) {
            return false;
        }
        
        $errorType = self::getErrorType($severity);
        $errorData = [
            'type' => 'PHP_ERROR',
            'severity' => $errorType,
            'message' => $message,
            'file' => $filename,
            'line' => $line,
            'url' => $_SERVER['REQUEST_URI'] ?? 'CLI',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'ip' => self::getClientIP(),
            'timestamp' => date('Y-m-d H:i:s'),
            'session_id' => session_id() ?: 'No session'
        ];
        
        self::logError($errorData);
        
        // Don't execute PHP internal error handler
        return true;
    }
    
    /**
     * Handle uncaught exceptions
     * @param Throwable $exception The exception
     */
    public static function handleException($exception) {
        $errorData = [
            'type' => 'UNCAUGHT_EXCEPTION',
            'severity' => 'FATAL',
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString(),
            'url' => $_SERVER['REQUEST_URI'] ?? 'CLI',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'ip' => self::getClientIP(),
            'timestamp' => date('Y-m-d H:i:s'),
            'session_id' => session_id() ?: 'No session'
        ];
        
        self::logError($errorData);
        
        // Show user-friendly error page
        if (!headers_sent()) {
            header('Location: /error.php?type=500');
            exit();
        }
    }
    
    /**
     * Handle fatal errors
     */
    public static function handleFatalError() {
        $error = error_get_last();
        if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
            $errorData = [
                'type' => 'FATAL_ERROR',
                'severity' => 'FATAL',
                'message' => $error['message'],
                'file' => $error['file'],
                'line' => $error['line'],
                'url' => $_SERVER['REQUEST_URI'] ?? 'CLI',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
                'ip' => self::getClientIP(),
                'timestamp' => date('Y-m-d H:i:s'),
                'session_id' => session_id() ?: 'No session'
            ];
            
            self::logError($errorData);
            
            // Show user-friendly error page
            if (!headers_sent()) {
                header('Location: /error.php?type=500');
                exit();
            }
        }
    }
    
    /**
     * Log custom application errors
     * @param string $message Error message
     * @param string $type Error type (INFO, WARNING, ERROR, CRITICAL)
     * @param array $context Additional context data
     */
    public static function logCustomError($message, $type = 'ERROR', $context = []) {
        $errorData = [
            'type' => 'APPLICATION_ERROR',
            'severity' => $type,
            'message' => $message,
            'context' => $context,
            'file' => debug_backtrace()[0]['file'] ?? 'Unknown',
            'line' => debug_backtrace()[0]['line'] ?? 0,
            'url' => $_SERVER['REQUEST_URI'] ?? 'CLI',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'ip' => self::getClientIP(),
            'timestamp' => date('Y-m-d H:i:s'),
            'session_id' => session_id() ?: 'No session'
        ];
        
        self::logError($errorData);
    }
    
    /**
     * Log HTTP errors (404, 500, etc.)
     * @param int $httpCode HTTP status code
     * @param string $message Error message
     * @param string $url Requested URL
     */
    public static function logHttpError($httpCode, $message, $url = null) {
        $errorData = [
            'type' => 'HTTP_ERROR',
            'severity' => $httpCode >= 500 ? 'ERROR' : 'WARNING',
            'http_code' => $httpCode,
            'message' => $message,
            'url' => $url ?: ($_SERVER['REQUEST_URI'] ?? 'Unknown'),
            'referer' => $_SERVER['HTTP_REFERER'] ?? 'Direct',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'ip' => self::getClientIP(),
            'timestamp' => date('Y-m-d H:i:s'),
            'session_id' => session_id() ?: 'No session'
        ];
        
        self::logError($errorData);
    }
    
    /**
     * Write error data to log file
     * @param array $errorData Error information
     */
    private static function logError($errorData) {
        // Rotate log file if it's too large
        self::rotateLogFile();
        
        // Format error message
        $logEntry = sprintf(
            "[%s] %s - %s: %s in %s:%s | URL: %s | IP: %s | UA: %s\n",
            $errorData['timestamp'],
            $errorData['type'],
            $errorData['severity'],
            $errorData['message'],
            $errorData['file'] ?? 'Unknown',
            $errorData['line'] ?? 'Unknown',
            $errorData['url'],
            $errorData['ip'],
            substr($errorData['user_agent'], 0, 100) // Truncate user agent
        );
        
        // Add trace if available
        if (isset($errorData['trace'])) {
            $logEntry .= "Stack trace:\n" . $errorData['trace'] . "\n";
        }
        
        // Add context if available
        if (isset($errorData['context']) && !empty($errorData['context'])) {
            $logEntry .= "Context: " . json_encode($errorData['context']) . "\n";
        }
        
        $logEntry .= str_repeat('-', 80) . "\n";
        
        // Write to log file
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    /**
     * Rotate log file if it exceeds maximum size
     */
    private static function rotateLogFile() {
        if (file_exists(self::$logFile) && filesize(self::$logFile) > self::$maxLogSize) {
            $backupFile = self::$logFile . '.' . date('Y-m-d-H-i-s') . '.bak';
            rename(self::$logFile, $backupFile);
            
            // Keep only last 5 backup files
            $backupFiles = glob(dirname(self::$logFile) . '/error.log.*.bak');
            if (count($backupFiles) > 5) {
                sort($backupFiles);
                for ($i = 0; $i < count($backupFiles) - 5; $i++) {
                    unlink($backupFiles[$i]);
                }
            }
        }
    }
    
    /**
     * Get error type string from severity level
     * @param int $severity Error severity
     * @return string Error type
     */
    private static function getErrorType($severity) {
        switch ($severity) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
                return 'FATAL';
            case E_WARNING:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_WARNING:
                return 'WARNING';
            case E_NOTICE:
            case E_USER_NOTICE:
                return 'NOTICE';
            case E_STRICT:
                return 'STRICT';
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                return 'DEPRECATED';
            default:
                return 'UNKNOWN';
        }
    }
    
    /**
     * Get client IP address
     * @return string Client IP
     */
    private static function getClientIP() {
        $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 
                  'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                        return $ip;
                    }
                }
            }
        }
        
        return $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    }
    
    /**
     * Get recent error logs
     * @param int $limit Number of recent errors to retrieve
     * @return array Recent error entries
     */
    public static function getRecentErrors($limit = 50) {
        if (!file_exists(self::$logFile)) {
            return [];
        }
        
        $lines = file(self::$logFile);
        $errors = [];
        $currentError = '';
        
        // Process log file from bottom to top
        for ($i = count($lines) - 1; $i >= 0 && count($errors) < $limit; $i--) {
            $line = trim($lines[$i]);
            
            if (strpos($line, str_repeat('-', 80)) === 0) {
                if (!empty($currentError)) {
                    $errors[] = $currentError;
                    $currentError = '';
                }
            } else {
                $currentError = $line . "\n" . $currentError;
            }
        }
        
        // Add the last error if exists
        if (!empty($currentError) && count($errors) < $limit) {
            $errors[] = $currentError;
        }
        
        return $errors;
    }
}

// Initialize error handler if not in CLI mode
if (php_sapi_name() !== 'cli') {
    ErrorHandler::init();
}
