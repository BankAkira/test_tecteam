import csv , time
import requests as rqz
from datetime import datetime
url = "recvdat.php"

with open('DataGen.csv', mode='r') as csv_file:
    csv_read = csv.reader(csv_file)
    line_count = 0
    for row in csv_read:
        if line_count == 0:
            line_count+=1
        else:
            date = datetime.strptime(row[0], "%d/%m/%Y").strftime("%Y-%m-%d")
            payload={'date':date, 'time':row[1], 'powerused':row[2], 'v1':row[3], 
            'v2':row[4], 'v3':row[5], 'i1':row[6], 'i2':row[7], 'i3':row[8],
            'p1':row[9], 'p2':row[10], 'p3':row[11], 'pf':row[12], 'hz':row[13], 'kwh':row[14]}
            r = rqz.get(url, params=payload)
            print(r.url)
            # time.sleep(0.1)
            line_count +=1
    print(f'Processed {line_count} line.')
    print("Done")