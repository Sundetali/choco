import json
import mysql.connector

with open('bokking.json', 'r') as f:
	booking = json.load(f)

arr_big = []
for client_data in booking:
	js_ticket = json.loads(client_data['js_ticket'])
	passes = js_ticket['passes']
	arr = []
	id_person = 0
	for elem in passes:
		dic = {}
		dic['id_person'] = id_person
		dic['name'] = elem['GivenName']
		dic['surname'] = elem['Surname']
		dic['eTicketNumber'] = elem['eTicketNumber']
		dic['Status'] = 'open'
		dic['TotalFare'] = elem['TotalFare']
		dic['Taxes'] = []
		dic['Routes'] = []
		for tax in elem['Taxes']:
			taxDic = {}
			taxDic['TaxType'] = tax['TaxType']
			taxDic['CountryCode'] = tax['CountryCode']
			taxDic['Amount'] = tax['Amount']
			dic['Taxes'].append(taxDic)
		
		for route in elem['Routes']:
			routeDic = {}
			routeDic['From'] = route['From']
			routeDic['To'] = route['To']
			routeDic['DepartureDate'] = route['DepartureDate']
			routeDic['ArrivalDate'] = route['ArrivalDate']
			dic['Routes'].append(routeDic)
		arr.append(dic)
		id_person+=1
	arr_big.append(arr)

print(json.dumps(arr_big, indent = 2))


mydb = mysql.connector.connect(
	host = 'localhost',
	user = 'root',
	passwd = '',
	database = 'choco'
)
mycursor = mydb.cursor()

sql = "Insert Into user_data (name,surname,status,DepartureAirport,ArrivalAirport,price_ticket) Values (%s, %s, %s,%s, %s, %s)"

for ar in arr_big:
	for user in ar:
		user_arr = {}
		
		user_arr['name'] = user['name']
		user_arr['surname'] = user['surname']
		user_arr['status'] = user['Status']

		for route in user['Routes']:
			user_arr['from'] = route['From']
			user_arr['to'] = route['To']

		user_arr['amount'] = 10000
		
		mycursor.execute(sql, (user_arr['name'], user_arr['surname'], user_arr['status'], user_arr['from'], user_arr['to'], user_arr['amount']) ) 

mydb.commit()
