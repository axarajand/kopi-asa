import pandas as pd
from sklearn.ensemble import GradientBoostingRegressor
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import OneHotEncoder
from sklearn.compose import ColumnTransformer
from sklearn.pipeline import Pipeline
import joblib

df = pd.read_csv('ml/dataset_coffee_quality.csv')

features = ['altitude_mean_meters', 'Variety', 'Processing.Method', 'Country.of.Origin', 'Moisture', 'Color']
target = 'Total.Cup.Points'

df.dropna(subset=features + [target], inplace=True)

# 3. Define categorical and numerical features
categorical_features = ['Variety', 'Processing.Method', 'Country.of.Origin', 'Color']
numerical_features = ['altitude_mean_meters', 'Moisture']

preprocessor = ColumnTransformer(
    transformers=[
        ('num', 'passthrough', numerical_features),
        ('cat', OneHotEncoder(handle_unknown='ignore'), categorical_features)
    ])

model = GradientBoostingRegressor(n_estimators=100, learning_rate=0.1, max_depth=3, random_state=42)

pipeline = Pipeline(steps=[('preprocessor', preprocessor),
                           ('regressor', model)])

X = df[features]
y = df[target]
pipeline.fit(X, y)

joblib.dump(pipeline, 'ml/coffee_quality_model.pkl')

print("Model training complete and saved to ml/coffee_quality_model.pkl")