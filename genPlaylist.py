import sys
import pandas as pd
import numpy as np
from sklearn.neighbors import NearestNeighbors as nn
import requests
import json
# import spotipy
# sp = spotipy.Spotify()
# from spotipy.oauth2 import SpotifyClientCredentials
# cid ="af2697ff1adb4b4baa20e069e032c4dd"
# secret = "c27d4eb2db9945a0b1a4944f77519414"
# client_credentials_manager = SpotifyClientCredentials(client_id=cid, client_secret=secret)
# sp = spotipy.Spotify(client_credentials_manager=client_credentials_manager)
# sp.trace=False


id = sys.argv[1]






if __name__ == "__main__":
    print(id)


# features_names = [] # get features from user selected categories
# audio_values = [] # need to query database to return features


# def BuildCustomPlaylist(song,features=[]):
#
#     sdf = fdf[fdf['name']==song]
#     vals = sdf[feats]
#     custom_df = fdf[features]
#
#     neighbor = nn(n_neighbors=10,algorithm='kd_tree',metric='euclidean', radius=3, n_jobs=-1)
#     neighbor.fit(custom_df)
#
#     distances, indicies = neighbor.kneighbors(X=vals,n_neighbors=10)
#
#     rdf = pd.DataFrame(columns=fdf.columns)
#     for i in indicies[0]:
#         rdf = rdf.append(fdf.iloc[i],ignore_index=True)
#     rdf['distance'] = pd.Series(distances[0], index=rdf.index)
#
#     return rdf
