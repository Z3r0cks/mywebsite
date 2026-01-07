import os
import sys
import io
from dotenv import load_dotenv
from google import genai
from google.genai import types

# Get the directory where the script is located
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
script_dir = os.path.dirname(os.path.abspath(__file__))
load_dotenv(os.path.join(script_dir, "../includes/.env"))
client = genai.Client(api_key=os.getenv('GEMINI_API_KEY'))


def run_rag_query(user_prompt, file_path):
    prompt = f"""Du bist ein erfahrener wissenschaftlicher KI-Forscher und Bewerbungscoach. Du schreibst präzise, selbstbewusst und faktenbasiert. Du vermeidest Übertreibungen und Marketing-Sprache. Du positionierst den Bewerber als Informatiker mit Forschungstiefe. Nutze ausschließlich die bereitgestellten Profilinformationen. Stelle den Bewerber als forschungsorientierten Informatiker dar. Betone technische Tiefe, Forschungskompetenz und Passung zur Stelle. Vermeide den Eindruck eines Design- oder Marketing-Schwerpunkts ohne es explizit zu erwähnen. Verwende keine Anrede und Grußformel. Begründe warum die Stelle zum Profil passt. Schreibe in der ersten Person (ich). Erstelle ein individuelles Anschreiben für folgende Stelle: {user_prompt}."""
        
    path_exist = False
    if os.path.exists(file_path):
        path_exist = True
    
    try:
        uploaded_file = client.files.upload(file=file_path, config=types.UploadFileConfig(mime_type="text/plain"))
    except Exception as e:
        return f"Error uploaded_file: {e}, file_path: {file_path}, path_exist: {path_exist}"
    
    try:
        
        response = client.models.generate_content(

            model="gemini-2.5-flash", contents=[
                uploaded_file,
                prompt
            ],
            config=types.GenerateContentConfig(
                temperature=0.2
            )
        )
        
        return response.text
    except Exception as e:
        return f"Error generate_content: {e}, uploaded_file: {uploaded_file}"

if __name__ == "__main__":
    prompt = sys.argv[1]
    path_to_doc = os.path.join(script_dir, "../includes/RAG/2a3921577af9d96c1b3d3038b5725ef00099ebf6.yaml")
    
    result = run_rag_query(prompt, path_to_doc)
    print(result)
    

