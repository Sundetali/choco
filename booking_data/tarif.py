import json
import pprint
import mysql.connector
#read and laod file as json
with open('tarif.json','r') as file:
	tarif = json.load(file)

tarif_xml = json.loads(tarif[39]['tarif_xml'])

#print json file
for rules in tarif_xml['rules']:
	for penalty in rules:
		if penalty['rule_code'] == 'PE':
			print(penalty)
pprint.pprint(tarif_xml)
# count=0
# for cid in tarif:
# 	print(count)
# 	count+=1
# 	print(cid['combination_id'])