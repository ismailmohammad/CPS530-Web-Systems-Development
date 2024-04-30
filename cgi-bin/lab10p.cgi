#!/usr/bin/python
import cgi
form = cgi.FieldStorage()
city = form.getvalue('city').upper()
province = form.getvalue('province').upper()
country = form.getvalue('country').upper()
image_url = form.getvalue('image_url')
print "Content-type: text/html\n\n<html><head><title>Problem 2 Result</title></head>"
print "<body style='text-align: center; background-color: #f3b6d8; color: crimson;'>"
print "<h1 style='font-size: 3em;'>{} - {}</h1><h1>{}</h1>".format(city, country, province)
print "<div style='width: 80%; margin: auto; border: 40px solid slateblue; border-radius: 1em;'>"
print "<img src='{}' style='width: 100%;'>".format(image_url)
print "</div></body></html>"
