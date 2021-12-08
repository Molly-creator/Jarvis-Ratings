import csv
import pandas as pd
import csv

import seaborn as sns
import matplotlib.pyplot as plt
import numpy as np
import matplotlib.patches as mpatches

from datetime import date

with open('./ratings.csv', 'r') as file:
    csv_file = csv.reader(file)
    data = [line for line in csv_file]

# __Totaal aantal ratings:__
# Loop door csv bestand en voeg, vanaf rij 1, de kolom 3 (rating) toe aan AllRatings.
# Met len() kun je eenvoudig het aantal waardes in AllRatings achterhalen.

# exercise,first_name,last_name,rating,date
# AllRatings = []

# for i in range(1,len(data)):
#     rating = int(data[i][3])
#     AllRatings.append(rating)

# print("In totaal zijn er", len(AllRatings), "ratings gegeven in Jarvis.", )

BitEx = pd.read_csv('./ratings.csv')

# Dataframe maken van kolom rating, dmv len() het aantal waardes bepalen.
Nmb_Excercises = len(BitEx['rating'])


print("In totaal zijn er over de opdrachten", Nmb_Excercises , "ratings gegeven in Jarvis.\n")
UniQueExcercises = BitEx['exercise'].unique()
print('Er zijn in dit databestand', len(UniQueExcercises),'opdrachten uit Jarvis, namelijk:',UniQueExcercises,'\n')



#Kolom met opdrachten, hiervan de unieke waardes achterhalen mgv 'unique()',
BitEx['exercise']

UniQueExcercises = BitEx['exercise'].unique()

print('Er zijn in dit databestand', len(UniQueExcercises),'opdrachten uit Jarvis, namelijk:',UniQueExcercises,'\n')
print('Ratings per opdracht :\n')

# Excercise_Ratings = BitExcercises.groupby('rating')['exercise']

ExRating = BitEx[BitEx.groupby(['exercise'])[['rating']].count().sort_values(by='rating',ascending=False)]
print(ExRating, '\n')
SrExcercise_RatingsSrExcercise_Ratings = BitEx[['exercise','rating']] = BitEx[['exercise','rating']]

#__ Opdrachten met gem < 3 __
LowRating = BitEx.groupby('exercise')['rating'].mean()
print("Er zijn",sum(LowRating < 3), "opdrachten met gemiddelde beoordeling lager dan 3.")
print("Dit zijn: \n", LowRating.tail(2))

#__ Ratings per opdracht dataverdeling__
ratingverdeling = BitEx.groupby('exercise')['rating'].value_counts()
ratingverdeling

a = BitEx[BitEx['exercise'] == 'Flex met boxen']['rating'].value_counts()
b = BitEx[BitEx['exercise'] == 'Commandline commands']['rating'].value_counts()
c = BitEx[BitEx['exercise'] == 'Read that data']['rating'].value_counts()
d = BitEx[BitEx['exercise'] == 'Maak een kattenwebsite']['rating'].value_counts()
e = BitEx[BitEx['exercise'] == 'Hover kan je gaan']['rating'].value_counts()

fig, axs = plt.subplots(5, figsize=(13,28))

valuesA = np.array(a)
labels=["1", "2","3","4","5"]
kleuren=['#53c68a', '#80b3ff','red','yellow','orange']
explode=(0.01, 0.01, 0.01, 0.01, 0.01)

valuesB = np.array(b)
labels=["1", "2","3","4","5"]
kleuren=['#53c68a', '#80b3ff','red','yellow','orange']
explode=(0.01, 0.01, 0.01, 0.01, 0.01)

valuesC = np.array(c)
labels=["1", "2","3","4","5"]
kleuren=['#53c68a', '#80b3ff','red','yellow','orange']
explode=(0.01, 0.01, 0.01, 0.01, 0.01)

valuesD = np.array(d)
labels=["1", "2","3","4","5"]
kleuren=['#53c68a', '#80b3ff','red','yellow','orange']
explode=(0.01, 0.01, 0.01, 0.01, 0.01)

valuesE = np.array(e)
labels=["1", "2","3","4","5"]
kleuren=['#53c68a', '#80b3ff','red','yellow','orange']
explode=(0.01, 0.01, 0.01, 0.01, 0.01)


axs[0].pie(valuesA, explode=explode, labels=labels, startangle = 90, colors=kleuren, textprops={'fontsize': 14},autopct='%1.1f%%')
axs[0].legend(title='rating',fontsize=20)
axs[0].set_title('Flex met boxen', fontsize=18)
axs[0].axis('equal')

axs[1].pie(valuesB, explode=explode, labels=labels, startangle = 90, colors=kleuren, textprops={'fontsize': 14}, autopct='%1.1f%%')
axs[1].legend(title='rating',fontsize=20)
axs[1].set_title('Commandline commands', fontsize=18)
axs[1].axis('equal')

axs[2].pie(valuesC, explode=explode, labels=labels, startangle = 90, colors=kleuren, textprops={'fontsize': 14},autopct='%1.1f%%')
axs[2].legend(title='rating',fontsize=20)
axs[1].set_title('Read that data', fontsize=18)
axs[2].axis('equal')

axs[3].pie(valuesD, explode=explode, labels=labels, startangle = 90, colors=kleuren, textprops={'fontsize': 14},autopct='%1.1f%%')
axs[3].legend(title='rating',fontsize=20)
axs[1].set_title('Maak een kattenwebsite', fontsize=18)
axs[3].axis('equal')

axs[4].pie(valuesE, explode=explode, labels=labels, startangle = 90, colors=kleuren, textprops={'fontsize': 14},autopct='%1.1f%%')
axs[4].legend(title='rating',fontsize=20)
axs[4].set_title('Hover kan je gaan', fontsize=18)
axs[4].axis('equal')

axs[0].legend(title="Rating",fontsize=20)

fig.suptitle("Verdeling rating 5 exercises Jarvis", fontsize=22)

plt.show()

#__Wijziging/herzien opdracht Flex met boxen__
#Omzetten naar DateTime cast->datatype
BitEx['date'] = BitEx['date'] .astype({'date': 'datetime64[ns]'})
pd.to_datetime(BitEx['date'])
BitEx['month'] = BitEx.date.dt.month_name()
BitEx['year'] = BitEx.date.dt.year

#----------------------------------------#
Flex = BitEx[BitEx['exercise'] == 'Flex met boxen']

Flex_month = Flex['month']

Flex_month

Flex = BitEx[BitEx['exercise'] == 'Flex met boxen']
FlexRating = Flex.groupby('month')['rating'].mean()
FlexRating.sort_values(ascending=False)

plt.figure(figsize=(16, 10))

sns.lineplot(data=BitEx[BitEx['exercise'] == 'Flex met boxen'], x='month',y='rating')
# plt.xticks(rotation=90)
# plt.yticks(rotation=0)
