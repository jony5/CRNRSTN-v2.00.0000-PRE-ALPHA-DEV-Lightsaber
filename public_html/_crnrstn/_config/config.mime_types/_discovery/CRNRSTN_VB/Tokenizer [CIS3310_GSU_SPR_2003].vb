Imports System

Public Class StringTokenizer
    
    Private s As String
    Private i As Integer
    Private sep As String   'token separator
    '------
    Public Sub New(ByVal st As String)
        MyBase.New()
        s = st         'copy in string
        sep = " "      'default separator
    End Sub
    '------
    Public Sub New(ByVal st As String, ByVal sepr As String)
        MyBase.New()
        s = st
        sep = sepr
    End Sub
    '------
    Public Sub setSeparator(ByVal sp As String)
        sep = sp      'copy separator
    End Sub
    '------
    Public Function nextToken() As String
        Dim tok As String
        Try
            i = s.IndexOf(sep)   'look for occurrence of separator

            If i > 0 Then       'if found
                tok = s.Substring(0, i).Trim             'return string to left
                s = s.Substring(i + 1).Trim 'shorten string  

            Else
                tok = s          'otherwise return end of string
                s = ""            'and set remainder to zero length
            End If
        Catch e As Exception
            tok = ""
        End Try
        Return tok
    End Function

End Class

