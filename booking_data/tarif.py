import json
import pprint
import mysql.connector
#read and laod file as json
with open('tarif.json','r') as file:
	tarif = json.load(file)

tarif_xml = json.loads(tarif[11]['tarif_xml'])

#print json file
for rules in tarif_xml['rules']:
	for penalty in rules:
		if penalty['rule_code'] == 'PE':
			pprint.pprint(penalty)


def getUser(tarif):
    idd = 0
    for user in tarif:
        print(idd)
        print(user['combination_id'])
        idd += 1
#getUser(tarif)
# count=0
# for cid in tarif:
# 	print(count)
# 	count+=1
# 	print(cid['combination_id'])