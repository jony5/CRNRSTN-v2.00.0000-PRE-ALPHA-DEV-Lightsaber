Public Class AppointmentSchedule
    Inherits System.Web.UI.Page

#Region " Web Form Designer Generated Code "

    'This call is required by the Web Form Designer.
    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()

    End Sub
    Protected WithEvents txtMonth As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtDay As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtYear As System.Web.UI.WebControls.TextBox
    Protected WithEvents Button1 As System.Web.UI.WebControls.Button
    Protected WithEvents link800 As System.Web.UI.WebControls.HyperLink
    Protected WithEvents HyperLink1 As System.Web.UI.WebControls.HyperLink

    'NOTE: The following placeholder declaration is required by the Web Form Designer.
    'Do not delete or move it.
    Private designerPlaceholderDeclaration As System.Object

    Private Sub Page_Init(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Init
        'CODEGEN: This method call is required by the Web Form Designer
        'Do not modify it using the code editor.
        InitializeComponent()
    End Sub

#End Region

    Private Sub Page_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        'Put user code to initialize the page here
        Dim apptDate
        If Not Page.IsPostBack Then
            txtMonth.Text = Month(Date.Now()).ToString
            txtDay.Text = Day(Date.Now()).ToString
            txtYear.Text = Year(Date.Now()).ToString
            apptDate = txtMonth.Text & "-" & txtDay.Text & "-" & txtYear.Text
            link800.NavigateUrl = "AppointmentDetails.aspx?Date=" & apptDate & "&time=8:00"
        End If
    End Sub

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        Dim apptDate As String = txtMonth.Text & "-" & txtDay.Text & "-" & txtYear.Text
        link800.NavigateUrl = "AppointmentDetails.aspx?Date=" & apptDate & "&time=8:00"
    End Sub
End Class
