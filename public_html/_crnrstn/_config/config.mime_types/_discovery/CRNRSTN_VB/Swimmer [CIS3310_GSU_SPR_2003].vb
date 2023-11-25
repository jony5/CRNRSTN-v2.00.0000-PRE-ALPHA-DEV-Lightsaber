Imports System
Imports System.ComponentModel
Imports System.Collections


Public Class Swimmer
    Private ssex As String
    Private sage As Integer
    Private stime As Single
    Private sclub As String
    Private sfrname, slname As String
    '-----
    Public Sub New(ByVal nm As String)
        MyBase.New()
        Dim i As Integer
        Dim s As String
        Dim t As Single
        Dim tok As StringTokenizer
        
        tok = New StringTokenizer(nm, ",")
        nm = tok.nextToken
        i = nm.indexOf(" ")
        If i > 0 Then       'separate into first and last
            sfrname = nm.substring(0, i)
            slname = nm.substring(i + 1)
        Else
            sfrname = ""
            slname = nm       'or just use one
        End If
        sage = CInt(tok.nextToken) 'get age
        sclub = tok.nextToken                  'get club
        stime = CSng(tok.nextToken)    'get time
        ssex = tok.nextToken                   'get sex
    End Sub
    '-----
    Public Function getTime() As Single
        getTime = stime
    End Function
    '-----
    Public Function getSex() As String
        getSex = ssex
    End Function
    '-----
    Public Function getName() As String
        getName = sfrname + " " + slname
    End Function
    '-----
    Public Function getClub() As String
        getClub = sclub
    End Function
    '-----
    Public Function getFirstName() As String
        Return sFrname
    End Function
    '-----
    Public Function getLastName() As String
        Return sLname
    End Function
    '-----
    Public Function getAge() As Integer
        getAge = sage
    End Function
    
End Class
