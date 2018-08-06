import json
import pprint

# import mysql.connector

with open('bokking.json', 'r') as f:
    booking = json.load(f)
js_id = booking[38]['cid']
js_ticket = json.loads(booking[38]['js_ticket'])
passes = js_ticket['passes']
arr = []


# userdata
def getUserData(elem, dic):
    dic['name'] = elem['GivenName']
    dic['surname'] = elem['Surname']
    dic['eTicketNumber'] = elem['eTicketNumber']
    dic['Status'] = 'open'
    dic['TotalFare'] = elem['TotalFare']
    dic['Taxes'] = []
    dic['Routes'] = []
    return dic


# taxes
def getTaxes(taxes, dic):
    for tax in taxes:
        taxDic = {}
        taxDic['TaxType'] = tax['TaxType']
        taxDic['CountryCode'] = tax['CountryCode']
        taxDic['Amount'] = tax['Amount']
        taxDic['TaxNature'] = tax['TaxNature']
        dic['Taxes'].append(taxDic)
    # pprint.pprint(taxDic)
    return dic


# routes
def getRoutes(routes, dic):
    for route in routes:
        routeDic = {}
        routeDic['From'] = route['From']
        routeDic['To'] = route['To']
        routeDic['DepartureDate'] = route['DepartureDate']
        routeDic['ArrivalDate'] = route['ArrivalDate']
        dic['Routes'].append(routeDic)
    return dic


for elem in passes:
    dic = {}
    getUserData(elem, dic)
    # print("\n")
    # print(dic['name'])
    # print("------------")

    getTaxes(elem['Taxes'], dic)
    getRoutes(elem['Routes'], dic)
    arr.append(dic)

taxes = []
#pprint.pprint(arr[0])
count_id = 0
for tax in arr[0]['Taxes']:
	taxDict = {}
	taxDict['id'] = count_id
	taxDict['CountryCode'] = tax['CountryCode']
	taxDict['TaxNature'] = tax['TaxNature']
	count_id+=1
	taxes.append(taxDict)
#pprint.pprint(taxes)



# pprint.pprint(arr)
# print(js_id)
# pprint.pprint(js_ticket['passes'])


def getUser(booking):
    idd = 0
    for user in booking:
        print(idd)
        print(user['cid'])
        for passes in json.loads(user['js_ticket'])['passes']:
            print(passes['GivenName'])
        idd += 1


getUser(booking)
count = 0

# mydb = mysql.connector.connect(
# 	host = 'localhost',
# 	user = 'root',
# 	passwd = '',
# 	database = 'choco'
# )
# mycursor = mydb.cursor()

# sql = "Insert Into user_data (name,surname,status,DepartureAirport,ArrivalAirport,price_ticket) Values (%s, %s, %s,%s, %s, %s)"

# for user in arr:
# 	user_arr = {}

# 	user_arr['name'] = user['name']
# 	user_arr['surname'] = user['surname']
# 	user_arr['status'] = user['Status']

# 	for route in user['Routes']:
# 		user_arr['from'] = route['From']
# 		user_arr['to'] = route['To']

# 		user_arr['amount'] = 10000
# 		mycursor.execute(sql, (user_arr['name'], user_arr['surname'], user_arr['status'], user_arr['from'], user_arr['to'], user_arr['amount']) ) 

# mydb.commit()

# print(mycursor.rowcount, "record inserted.")
