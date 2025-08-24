from flask import Flask, request, jsonify
import joblib
import pandas as pd
import numpy as np

app = Flask(__name__)

try:
    pipeline = joblib.load('ml/coffee_quality_model.pkl')
    print("Model loaded successfully!")
except FileNotFoundError:
    print("Error: Model file not found! Make sure 'coffee_quality_model.pkl' is in the 'ml' directory.")
    pipeline = None

@app.route('/predict', methods=['POST'])
def predict():
    if pipeline is None:
        return jsonify({'error': 'Model not loaded'}), 500

    data = request.get_json()
    
    input_data = pd.DataFrame({
        'altitude_mean_meters': [float(data.get('altitude', 1200))],
        'Variety': [data.get('variety', 'Unknown')],
        'Processing.Method': [data.get('processing_method', 'Washed / Wet')],
        'Country.of.Origin': [data.get('country', 'Indonesia')],
        'Moisture': [float(data.get('moisture', 0.11))],
        'Color': [data.get('color', 'Green')]
    })

    try:
        prediction = pipeline.predict(input_data)
        result = round(float(prediction[0]), 2)
        return jsonify({'success': True, 'score': result})
    except Exception as e:
        return jsonify({'error': str(e)}), 400

if __name__ == '__main__':
    app.run(port=5000, debug=True)