#!/usr/bin/ruby
require 'cgi'
cgi = CGI.new
city = cgi['city'].capitalize
province = cgi['province'].capitalize
country = cgi['country'].capitalize
image_url = cgi['image_url']
puts "Content-type: text/html\n\n<html><head><title>Problem 2 Result</title></head>"
puts "<body style='text-align: center; background-color: #f3b6d8; color: crimson;'>"
puts "<h1 style='font-size: 3em;'>#{city} - #{country}</h1><h1>#{province}</h1>"
puts "<img src='#{image_url}' style='width: 100%;'>"
puts "</body></html>"
