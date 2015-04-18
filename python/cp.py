import os
import sys
import redis
import time

if __name__=="__main__":
    time.sleep(10)
    #redis_context = redis.StrictRedis(host='10.13.130.101', port=6379, db=0)
    input = sys.argv[1]
    output = sys.argv[2]
    os.system("cp "+ input + " " + output)

