<?php
use PHPUnit\Framework\TestCase;

class DbConnectTest extends TestCase
{
    public function testConnectionUsesEnvVariables()
    {
        $content = file_get_contents(__DIR__ . '/../includes/db_connect.php');
        $this->assertStringContainsString('$_ENV[\'DB_HOST\']', $content);
        $this->assertStringContainsString('$_ENV[\'DB_NAME\']', $content);
        $this->assertStringContainsString('$_ENV[\'DB_USER\']', $content);
        $this->assertStringContainsString('$_ENV[\'DB_PASS\']', $content);
        $this->assertStringContainsString('new PDO', $content);
    }
}
