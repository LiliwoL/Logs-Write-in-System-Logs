import win32api
import win32con
import win32evtlog
import win32security
import win32evtlogutil

ph = win32api.GetCurrentProcess()
th = win32security.OpenProcessToken(ph, win32con.TOKEN_READ)
my_sid = win32security.GetTokenInformation(th, win32security.TokenUser)[0]

applicationName = "Mon Application BTS SIO"
eventID = 1
category = 5  # Shell
myType = win32evtlog.EVENTLOG_WARNING_TYPE  # A warning
descr = ["A warning", "An even more dire warning"]  # A list of strings
data = "Application\0Data".encode("ascii")  # A string of bytes

win32evtlogutil.ReportEvent(applicationName, eventID, eventCategory=category,
                            eventType=myType, strings=descr, data=data, sid=my_sid)
