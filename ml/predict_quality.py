import joblib
import pandas as pd
import sys

pipeline = joblib.load('ml/coffee_quality_model.pkl')

altitude = float(sys.argv[1])
variety = sys.argv[2]
processing_method = sys.argv[3]
country = sys.argv[4]
moisture = float(sys.argv[5])
color = sys.argv[6]

input_data = pd.DataFrame({
    'altitude_mean_meters': [altitude],
    'Variety': [variety],
    'Processing.Method': [processing_method],
    'Country.of.Origin': [country],
    'Moisture': [moisture],
    'Color': [color]
})

prediction = pipeline.predict(input_data)

print(round(prediction[0], 2))