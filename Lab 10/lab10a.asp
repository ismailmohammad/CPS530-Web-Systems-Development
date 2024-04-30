<%
bg = Request.QueryString("bg")
Function IsValidHexCode(str)
    Dim hexRegex
    Set hexRegex = New RegExp
    hexRegex.Pattern = "^#?([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$"
    IsValidHexCode = hexRegex.Test(str)
End Function
If IsValidHexCode(bg) Then
    bg = "#" & bg
End If
response.write("The colour selected was " & bg & ". <br/>")

If Request.Cookies("LastVisit") <> "" Then
    lastVisit = Request.Cookies("LastVisit")
    Response.Write("The last visit was stored as: " & lastVisit)
    currentDateTime = Now
    Response.Cookies("LastVisit") = currentDateTime
Else
    currentDateTime = Now
    Response.Cookies("LastVisit") = currentDateTime
    Response.Write("This is the first visit to this website by you.")
End If

%>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab 10 Part A - ASP</title>
  </head>
  <body style="background: <%=bg%>">
  </body>
</html>
