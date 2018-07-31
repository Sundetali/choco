import json
import datetime
import pandas as pd
from sqlalchemy import create_engine
import pprint as pprint


pd.set_option('display.max_rows', 500)
pd.set_option('display.max_columns', 500)
pd.set_option('display.width', 1000)

with open('bokking.json') as data_file:    
    data = json.load(data_file)
ticket_info = data[13]['js_ticket']
load = json.loads(ticket_info)
user_info = load['passes']


def calc(dep_time):
    ##realtime date
    date = (datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"))
    
    dep = int(datetime.datetime.strptime(dep_time, '%Y-%m-%dT%H:%M:%S').strftime("%s"))
    date_now = int(datetime.datetime.strptime(date, '%Y-%m-%d %H:%M:%S').strftime("%s"))

    print(dep, dep_now)
    if(dep - date_now > 0):
        return ('open')
    else:
        return ('close')
    
def getUser(data):
    user_dict = {'id': [],'name': [],'surname': [],'total_price': [],'ticket_id': []}
    tax_dict = {'id': [], 'price': [],'tax_nature': [],'tax_type': []}
    dep_dict = {'id': [], 'status': [], 'dep_time': [], 'arr_time': [], 'from_loc': [], 'to_loc': [],'fare_basis': []}
    count = 1

    for i in data:
        # pprint.pprint(i)
        user_dict['id'].append(count)
        user_dict['name'].append(i['GivenName'])
        user_dict['surname'].append(i['Surname'])
        user_dict['total_price'].append(int(i['TotalFare']))
        user_dict['ticket_id'].append(i['eTicketNumber'])
        print(user_dict)    
        for route in i['Routes']:
            arr_time = (datetime.datetime.strptime(route['ArrivalDate'], '%Y-%m-%dT%H:%M:%S'))
            dep_time = (datetime.datetime.strptime(route['DepartureDate'], '%Y-%m-%dT%H:%M:%S'))

            dep_dict['id'].append(count)
           ## dep_dict['status'].append(calc(route['DepartureDate']))
            dep_dict['status'].append("open")
            dep_dict['dep_time'].append(dep_time)
            dep_dict['arr_time'].append(arr_time)
            dep_dict['from_loc'].append(route['From'])
            dep_dict['to_loc'].append(route['To'])
            dep_dict['fare_basis'].append(route['FareBasis'])

        for tax in i['Taxes']:
            tax_dict['id'].append(count)
            tax_dict['price'].append(int(tax['Amount']))
            tax_dict['tax_nature'].append(tax['TaxNature'])
            tax_dict['tax_type'].append(tax['TaxType'])
        count += 1

    dep_df = pd.DataFrame(data = dep_dict)
    tax_df = pd.DataFrame(data = tax_dict)
    user_df = pd.DataFrame(data = user_dict)

    print(tax_df)
    print(user_df)
    print(dep_df)
    return (user_df, tax_df,dep_df )


def saveSQL(data):
    engine = create_engine("mysql+mysqlconnector://root:@localhost/choco")
    con = engine.connect()
    data[0].to_sql(name='user_data',con=engine, if_exists='replace', index= False)
    data[1].to_sql(name = 'tax_data',con = engine, if_exists = 'replace', index= False)
    data[2].to_sql(name='dep_data', con=engine, if_exists='replace', index= False)
saveSQL(getUser(user_info))