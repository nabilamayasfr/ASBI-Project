import os
import cv2
import numpy as np
import mediapipe as mp
from mediapipe.tasks import python
from mediapipe.tasks.python import vision


BASE_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
MODEL_TASK_PATH = os.path.join(BASE_DIR, "hand_landmarker.task")


def normalize_landmarks(landmarks):
    landmarks = np.array(landmarks, dtype=np.float32)

    wrist = landmarks[0].copy()
    landmarks = landmarks - wrist

    max_value = np.max(np.abs(landmarks))

    if max_value != 0:
        landmarks = landmarks / max_value

    return landmarks


def create_hand_landmarker():
    base_options = python.BaseOptions(model_asset_path=MODEL_TASK_PATH)

    options = vision.HandLandmarkerOptions(
        base_options=base_options,
        num_hands=1,
        min_hand_detection_confidence=0.5,
        min_hand_presence_confidence=0.5,
        min_tracking_confidence=0.5
    )

    return vision.HandLandmarker.create_from_options(options)


def extract_landmarks_from_image(image_bytes):
    np_arr = np.frombuffer(image_bytes, np.uint8)
    image_bgr = cv2.imdecode(np_arr, cv2.IMREAD_COLOR)

    if image_bgr is None:
        return None

    image_rgb = cv2.cvtColor(image_bgr, cv2.COLOR_BGR2RGB)

    mp_image = mp.Image(
        image_format=mp.ImageFormat.SRGB,
        data=image_rgb
    )

    with create_hand_landmarker() as landmarker:
        result = landmarker.detect(mp_image)

    if not result.hand_landmarks:
        return None

    hand_landmarks = result.hand_landmarks[0]

    landmarks = []

    for lm in hand_landmarks:
        landmarks.append([lm.x, lm.y, lm.z])

    landmarks = normalize_landmarks(landmarks)

    return landmarks.reshape(1, 21, 3)