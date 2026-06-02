from fastapi import FastAPI, UploadFile, File, Form
from fastapi.middleware.cors import CORSMiddleware
import tensorflow as tf
import numpy as np
import json
import os

from utils.preprocess import extract_landmarks_from_image

app = FastAPI(title="SIGNLEARN AI API")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

BASE_DIR = os.path.dirname(os.path.abspath(__file__))

MODEL_PATHS = {
    "BISINDO": {
        "model": os.path.join(BASE_DIR, "models", "BISINDO", "best_bisindo_model_fixed.keras"),
        "classes": os.path.join(BASE_DIR, "models", "BISINDO", "class_names.json"),
    },
    "SIBI": {
        "model": os.path.join(BASE_DIR, "models", "SIBI", "best_sibi_model_fixed.keras"),
        "classes": os.path.join(BASE_DIR, "models", "SIBI", "class_names.json"),
    }
}

models = {}
class_names = {}


@app.on_event("startup")
def load_models():
    for module, paths in MODEL_PATHS.items():
        models[module] = tf.keras.models.load_model(paths["model"], compile=False)

        with open(paths["classes"], "r") as f:
            class_names[module] = json.load(f)

    print("Model BISINDO dan SIBI berhasil dimuat.")


@app.get("/")
def home():
    return {
        "message": "SIGNLEARN FastAPI aktif",
        "available_modules": ["BISINDO", "SIBI"]
    }


@app.post("/predict")
async def predict(
    module: str = Form(...),
    file: UploadFile = File(...)
):
    try:
        module = module.upper()

        if module not in models:
            return {
                "success": False,
                "message": "Module tidak valid. Gunakan BISINDO atau SIBI.",
                "prediction": None,
                "confidence": 0
            }

        image_bytes = await file.read()

        features = extract_landmarks_from_image(image_bytes)

        if features is None:
            return {
                "success": False,
                "module": module,
                "message": "Tangan tidak terdeteksi.",
                "prediction": None,
                "confidence": 0
            }

        print("Shape features:", features.shape)

        prediction = models[module].predict(features)

        class_index = int(np.argmax(prediction))
        confidence = float(np.max(prediction))
        predicted_label = class_names[module][class_index]

        return {
            "success": True,
            "module": module,
            "prediction": predicted_label,
            "confidence": confidence
        }

    except Exception as e:
        return {
            "success": False,
            "message": "Terjadi error saat prediksi.",
            "error": str(e)
        }