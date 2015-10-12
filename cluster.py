__author__ = 'sneha'

import json
import numpy.numarray
import pprint
import utility
from sklearn.cluster import KMeans

json_data=open('config').read()
data = json.loads(json_data)

train_data_file = data['train']
train_data = open(train_data_file)

# location contains longitude and latitude of an image
location_in_degrees = [(line.split()[-2],line.split()[-1]) for line in train_data.xreadlines()]
location_list = [utility.convert_to_cartesian(float(loc[0]), float(loc[1]), float(6371)) for loc in location_in_degrees]

location = numpy.matrix(location_list)

