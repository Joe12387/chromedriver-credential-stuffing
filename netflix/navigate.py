import warnings

warnings.filterwarnings('ignore')

import undetected_chromedriver.v2 as uc
import time
import random
import sys

user_name = sys.argv[1]
password = sys.argv[2]

options = uc.ChromeOptions()

# setting profile
options.user_data_dir = sys.argv[3]

# just some options passing in to skip annoying popups
options.add_argument('no-first-run no-service-autorun password-store=basic no-default-browser-check')

driver = uc.Chrome(options=options)

driver.get("https://www.netflix.com/us/login")

time.sleep(1)

element = driver.find_element_by_id("id_userLoginId")
element.send_keys(user_name)
element = driver.find_element_by_id("id_password")
element.send_keys(password)
element.send_keys("\n")

time.sleep(2);

element = driver.find_element_by_xpath("//*")
source_code = element.get_attribute("outerHTML")

print(source_code)

driver.close()
