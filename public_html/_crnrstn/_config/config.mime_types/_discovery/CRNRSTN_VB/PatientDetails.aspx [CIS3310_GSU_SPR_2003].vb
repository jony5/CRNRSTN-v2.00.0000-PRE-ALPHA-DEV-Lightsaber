Public Class PatientDetails
    Inherits System.Web.UI.Page

#Region " Web Form Designer Generated Code "

    'This call is required by the Web Form Designer.
    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()

    End Sub
    Protected WithEvents txtFirstName As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtMiddleName As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtLastName As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtAddress1 As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtAddress2 As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtCity As System.Web.UI.WebControls.TextBox
    Protected WithEvents TextBox6 As System.Web.UI.WebControls.TextBox
    Protected WithEvents TextBox7 As System.Web.UI.WebControls.TextBox
    Protected WithEvents TextBox8 As System.Web.UI.WebControls.TextBox
    Protected WithEvents TextBox9 As System.Web.UI.WebControls.TextBox
    Protected WithEvents TextBox10 As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtBirthMonth As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtBirthDay As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtBirthYear As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtState As System.Web.UI.WebControls.DropDownList
    Protected WithEvents txtGender As System.Web.UI.WebControls.DropDownList
    Protected WithEvents txtSSN1 As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtSSN2 As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtSSN3 As System.Web.UI.WebControls.TextBox
    Protected WithEvents btnInsurance As System.Web.UI.WebControls.Button
    Protected WithEvents btnHistory As System.Web.UI.WebControls.Button
    Protected WithEvents TextBox1 As System.Web.UI.WebControls.TextBox
    Protected WithEvents btnSearch As System.Web.UI.WebControls.Button
    Protected WithEvents btnSave As System.Web.UI.WebControls.Button
    Protected WithEvents btnCancel As System.Web.UI.WebControls.Button

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
    End Sub

    Private Sub btnHistory_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnHistory.Click
        Response.Redirect("MedicalHistory.aspx")
    End Sub

    Private Sub btnInsurance_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnInsurance.Click
        Response.Redirect("InsuranceInformation.aspx")
    End Sub
End Class
