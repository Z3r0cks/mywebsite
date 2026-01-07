from sentence_transformers import SentenceTransformer, util
import torch

# 1. Kleines, schnelles Modell laden (läuft lokal auf CPU/GPU)
model = SentenceTransformer('all-MiniLM-L6-v2')

# 2. Dein Ziel-Profil definieren (stark gewichtet auf deine Kernkompetenzen)
my_profile = """
Master of Science Informatik, Schwerpunkt Künstliche Intelligenz, 
Deep Learning, Computer Vision, Machine Learning Engineering, 
Forschung und Entwicklung, PyTorch, TensorFlow. 
Kein Design, kein Marketing.
"""

# 3. Beispielhafte Funde aus einem Scraper (Titel + Snippet)
jobs = [
    "Machine Learning Engineer (m/w/d) - Deep Learning & Computer Vision",
    "Fachinformatiker für Systemintegration im First-Level-Support",
    "KI-Forscher für generative Modelle und neuronale Netze",
    "Webdesigner mit Fokus auf UI/UX und HTML/CSS"
]

# Vektoren (Embeddings) berechnen
profile_vector = model.encode(my_profile, convert_to_tensor=True)
job_vectors = model.encode(jobs, convert_to_tensor=True)

# 4. Kosinus-Ähnlichkeit berechnen
cosine_scores = util.cos_sim(profile_vector, job_vectors)[0]

# 5. Ergebnisse filtern (z.B. alles über 0.45)
print("Filter-Ergebnisse:")
for i, score in enumerate(cosine_scores):
    if score > 0.45:
        print(f"PASSEND ({score:.2f}): {jobs[i]}")
    else:
        print(f"VERWORFEN ({score:.2f}): {jobs[i]}")