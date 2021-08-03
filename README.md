# chromedriver Credential Stuffing
 This is a collection of brute forcing code I had lying around for conducting credential stuffing attacks on certain popular websites to gauge each site's countermeasures against this type of attack. I've written most of the logic portions in PHP while leaving basic chromedriver functionality to Python. I would have written it all in Python, but I just have more experience in PHP. Pretty? No. Effective? Very.
 
 Paired with a good source of credentials, this brute forcer is able to conduct attacks pretty much indefinitely, finding valid credentials for an alarming amount of accounts. You will need your own list of credentials. I used a particularly fruitful file from the ANTIPUBLIC #1 collection.
 
 This supports macOS only, but could conceivably work on another UNIX OS.
 
 Not all code has been released in order to prevent abuse, and there is purposely little documentation. However, you'll need the following to start:
 * Python 3.6+
 * PHP 7.0+
 * undetected-chromedriver (pip install undetected-chromedriver)
 * Private Internet Access w/ piactl (I believe it's installed by default)
 * A list of credentials in email:password format
 
 
 **I am not responsible for what you use this code for. Please don't be evil.**
 
# Features

* Uses ultrafunkamsterdam/undetected-chromedriver to evade bot detection
* Uses a VPN (Private Internet Access) and periodically changes IPs using the piactl CLI utility to prevent rate limiting

# Support
* Netflix (may add more in the future)
