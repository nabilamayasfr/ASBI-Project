import zipfile
import json
import shutil
import os


def remove_quantization_config(obj):
    if isinstance(obj, dict):
        obj.pop("quantization_config", None)
        for value in obj.values():
            remove_quantization_config(value)
    elif isinstance(obj, list):
        for item in obj:
            remove_quantization_config(item)


def fix_keras_file(input_path, output_path):
    temp_path = input_path + "_temp"

    with zipfile.ZipFile(input_path, "r") as zin:
        with zipfile.ZipFile(temp_path, "w") as zout:
            for item in zin.infolist():
                data = zin.read(item.filename)

                if item.filename == "config.json":
                    config = json.loads(data.decode("utf-8"))
                    remove_quantization_config(config)
                    data = json.dumps(config).encode("utf-8")

                zout.writestr(item, data)

    shutil.move(temp_path, output_path)
    print(f"Berhasil dibuat: {output_path}")


fix_keras_file(
    "models/BISINDO/best_bisindo_model.keras",
    "models/BISINDO/best_bisindo_model_fixed.keras"
)

fix_keras_file(
    "models/SIBI/best_sibi_model.keras",
    "models/SIBI/best_sibi_model_fixed.keras"
)