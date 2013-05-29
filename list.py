#/usr/bin/python
import os, sys, string, time
import MySQLdb as mdb

#This function convert the date in email to MySQL date format
def dateconvert(dateWild):
	data = dateWild.split()
	data_dby = ' '.join(data[2:5])
	dateAll = time.strptime(data_dby,"%d %b %Y")
	dateMild = time.strftime("%Y-%m-%d",dateAll)
	return dateMild
	
#This function reads the job details from each mail file and 
#store job details in a database named hpc_job
def readJobDetail(inputFile):
	f = open("%s" % inputFile, "r")
	startFlag = 0;endFlag = 0
	dateCount =0;idCount = 0;nameCount = 0
	jobDate = 0;jobId = 0;jobName = "NOT SPECIFIED";jobDeleted = 0;
	#Initialize connection to database
	db = mdb.connect(host="localhost",user="hpc_job_user",passwd="hpc_job_pwd",db="hpc_job")
	#Create a Cursor object to execute query
	jobCur = db.cursor()

	for line in f.readlines():
		if not line.strip():
			continue
		detail = line.split()
		if (detail[0] == "Date:") and (dateCount == 0):
			jobDate = dateconvert(line)
			dateCount = dateCount + 1
			#print jobDate
		elif detail[0] == "PBS":
			if (detail[1] == "Job") and (detail[2] == "Id:") and (idCount == 0):
				jobId = detail[3]
				idCount = idCount + 1
				#print jobId
		elif detail[0] == "Job":
			if (detail[1] == "Name") and (nameCount == 0):
				jobName = detail[2]
				nameCount = nameCount +1
				#print jobName
		elif line =="Begun execution\n":
			startFlag = 1
		elif line =="Execution terminated\n":
			endFlag = 1
		elif line =="job deleted\n":
			endFlag = 2
		elif line[:-9] =="resources_used.walltime=":
			wallTime=line[-9:-1]
		else:
			continue
	if (startFlag == 1) and (endFlag == 0):
		startDate = jobDate
		jobCur.execute("""INSERT INTO job_detail VALUES (%s,%s,%s,NULL,NULL,NULL)""",(jobId,jobName,startDate))
		db.commit()
	elif (startFlag == 0) and (endFlag == 1):
		endDate = jobDate
		jobCur.execute("""UPDATE job_detail SET end_date=%s,used_time=%s WHERE job_id=%s""",(endDate,wallTime,jobId))
		db.commit()
	elif (startFlag ==0) and (endFlag == 2):
		deleteDate = jobDate
		jobDeleted = 1;
	else:
		print "Start and end flag is wrong!\n"
	#print startFlag,endFlag

def main(argv):
	#List mail file and store file name in fileList
	str = os.popen("ls").read()
	fileList = str.split("\n")
	for i in range(len(fileList)):
		#if file name is not list.py and backup, treated as new mail
		if (fileList[i] != "list.py") and (fileList[i] != "backup") and (fileList[i] != ""):
			readJobDetail(fileList[i])
			#Move mail file to backup after getting job detail
			os.system("mv %s backup" % fileList[i])

if __name__ == '__main__':
        main(sys.argv[1:])


