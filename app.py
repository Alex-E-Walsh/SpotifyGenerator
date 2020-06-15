from flask import Flask, render_template, request
from flask_sqlalchemy import SQLAlchemy
import psycopg2 as pg
import os
import pandas as pd
import numpy as np
from sklearn.neighbors import NearestNeighbors as nn
from sklearn.preprocessing import MinMaxScaler as mms
# import joblib

app = Flask(__name__)

try:
    DATABASE_URL = os.environ['DATABASE_URL']
    conn = pg.connect(DATABASE_URL, sslmode='require')
    cur = conn.cursor()
except:
    print("I am unable to connect to the database")

def buildResultHTML(qres):
    response = ""
    for val in qres:
        response = response + "<li>"+val[0]+" By: "+val[1]+"</li>"
    response = "<ul>"+response+"</ul>"
    return response

@app.route('/query',methods=['GET','POST'])
def Querydb():
    usr_inp = request.form['q']
    sql = 'SELECT title, artists from cleaned_songs WHERE title ILIKE %s or artists ILIKE %s ORDER BY popularity DESC LIMIT 15'
    search_term = usr_inp
    like_pattern = '%{}%'.format(search_term)
    cur.execute(sql, (like_pattern, like_pattern))
    results = cur.fetchall()
    response =  "<ul><li>No data found</li></ul>"
    if(len(results)>0):
        response = buildResultHTML(results)
    return response

@app.route('/getcode', methods=['POST','GET'])
def buildcode():
    selectedsong = request.form['sc']
    selectedsong = '{}'.format(selectedsong)
    sql = "SELECT id FROM cleaned_songs WHERE title = %s"
    cur.execute(sql,(selectedsong,));
    sid = cur.fetchall()[0][0]
    return sid


@app.route("/genplaylist",methods=['POST','GET'])
def genPlaylist():
    #read in dataframes
    df = pd.read_csv("spotify_data/cleaned_df.csv")
    df.drop("Unnamed: 0",axis=1,inplace=True)
    sdf = pd.read_csv("spotify_data/scaled_song_data.csv")
    sdf.drop("Unnamed: 0",axis=1,inplace=True)
    #read in knn model from joblib
    # nghbr = joblib.load("spotify_data/knn_jblib.pkl")
    #read user inputted song + selected features
    feats = request.form['features']
    #clean feature array from json
    feats = feats.strip('[').strip(']').split(',')
    feats = [e.strip('"') for e in feats]
    id = feats[-1]
    feats = feats[:-1]
    # get audio features from scaled csv
    audioVals = sdf[sdf['id']==id][feats]
    #make custom training data for each features
    custom_df = sdf[feats]
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

    return rdf

@app.route('/')
def home():
    return render_template('index.html')

if __name__ =="__main__":
    app.run(debug=True)
