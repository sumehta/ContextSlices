__author__ = 'sneha'
import json
import numpy.numarray
import utility
from sklearn.cluster import MeanShift, estimate_bandwidth

json_data=open('config').read()
data = json.loads(json_data)

train_data_file = data['train']
train_data = open(train_data_file)

# location contains longitude and latitude of an image
location_in_degrees = [(line.split()[-2],line.split()[-1]) for line in train_data.xreadlines()]
location_list = [(utility.convert_to_cartesian(float(loc[0]), float(loc[1]), float(6371)))
                for loc in location_in_degrees]

location = numpy.zeros(shape=(len(location_list),3))

location_arr = numpy.array(location_list)

for i in range(len(location_arr)):
    location[i][0] = location_arr[i][0]
    location[i][1] = location_arr[i][1]
    location[i][2] = location_arr[i][2]

# The following bandwidth can be automatically detected using
bandwidth = estimate_bandwidth(location, quantile=0.2, n_samples=500)
ms = MeanShift(bandwidth=bandwidth, bin_seeding=True)
ms.min_bin_freq = 250
ms.fit(location)
labels = ms.labels_
cluster_centers = ms.cluster_centers_


print labels
print len(cluster_centers)