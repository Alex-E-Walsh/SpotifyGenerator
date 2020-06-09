import sys
import pandas as pd
import numpy as np
from sklearn.neighbors import NearestNeighbors as nn
import requests
import json
import base64
import joblib
# import spotipy
# sp = spotipy.Spotify()
# from spotipy.oauth2 import SpotifyClientCredentials
# cid ="af2697ff1adb4b4baa20e069e032c4dd"
# secret = "c27d4eb2db9945a0b1a4944f77519414"
# client_credentials_manager = SpotifyClientCredentials(client_id=cid, client_secret=secret)
# sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
# sp.trace=False

#read in dataframe
df = pd.read_csv("spotify_data/cleaned_df.csv")
df.drop("Unnamed: 0",axis=1,inplace=True)

#read in knn model from joblib
nghbr = joblib.load("spotify_data/knn_jblib.pkl")

#read user inputted song + selected features
feats = sys.argv[1]
feats = feats.strip('[').strip(']').split(',')
id = feats[-1]
feats = feats[:-1]

# get audio features from csv
audioVals = df[df['id']==id][feats]

#make custom training data for each features
custom_df = df[feats]

#build specific knn using user selected features
neighbor = nn(n_neighbors=10,algorithm='kd_tree',metric='euclidean', n_jobs=-1)
neighbor.fit(custom_df)

distances, indicies = neighbor.kneighbors(X=audioVals,n_neighbors=10)

#store the generated playlist in a dataframe
rdf = pd.DataFrame(columns=df.columns)
for i in indicies[0]:
    rdf = rdf.append(df.iloc[i],ignore_index=True)
rdf['distance'] = pd.Series(distances[0].round(3), index=rdf.index)
rdf.drop(['explicit','release_date','duration_ms'],axis=1,inplace=True)
#store as JSON object
rdf = rdf.to_json()

if __name__ == "__main__":
    print(rdf)
