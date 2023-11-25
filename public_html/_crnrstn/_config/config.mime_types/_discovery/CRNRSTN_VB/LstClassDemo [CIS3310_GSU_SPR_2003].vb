Public Class LstClassDemo
    Inherits System.Windows.Forms.Form
    Private swimmers As ArrayList
    'moved so WithClass will pick them up
    Friend WithEvents lsNames As ClassAdapter.OurList
    Friend WithEvents lsKids As ClassAdapter.OurList
    Friend WithEvents Moveit As System.Windows.Forms.Button

    Public Sub init()
        swimmers = New ArrayList()
        ReadFile()
    End Sub

    Private Sub ReadFile()
        Dim s As String
        Dim sw As Swimmer
        Dim fl As New vbFile("swimmers.txt")
        fl.OpenForRead()
        s = fl.readLine
        While Not fl.fEOF
            sw = New Swimmer(s)
            swimmers.Add(sw)
            lsNames.addItem(sw.getName)
            s = fl.readLine
        End While
    End Sub

    Private Sub Moveit_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Moveit.Click
        Dim i As Integer
        Dim sw As Swimmer
        i = lsNames.ListIndex
        sw = CType(swimmers(i), Swimmer)
        lsKids.addText(sw)
    End Sub
#Region " Windows Form Designer generated code "

    Public Sub New()
        MyBase.New()

        'This call is required by the Windows Form Designer.
        InitializeComponent()

        'Add any initialization after the InitializeComponent() call
        init()
    End Sub

    'Form overrides dispose to clean up the component list.
    Protected Overloads Overrides Sub Dispose(ByVal disposing As Boolean)
        If disposing Then
            If Not (components Is Nothing) Then
                components.Dispose()
            End If
        End If
        MyBase.Dispose(disposing)
    End Sub
    '    Friend WithEvents lsNames As ClassAdapter.OurList
    '    Friend WithEvents lsKids As ClassAdapter.OurList
    '    Friend WithEvents Moveit As System.Windows.Forms.Button

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.Container

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()
        Me.lsNames = New ClassAdapter.OurList()
        Me.Moveit = New System.Windows.Forms.Button()
        Me.lsKids = New ClassAdapter.OurList()
        Me.SuspendLayout()
        '
        'lsNames
        '
        Me.lsNames.Location = New System.Drawing.Point(8, 48)
        Me.lsNames.Name = "lsNames"
        Me.lsNames.Size = New System.Drawing.Size(160, 186)
        Me.lsNames.TabIndex = 0
        '
        'Moveit
        '
        Me.Moveit.Location = New System.Drawing.Point(176, 96)
        Me.Moveit.Name = "Moveit"
        Me.Moveit.Size = New System.Drawing.Size(40, 24)
        Me.Moveit.TabIndex = 2
        Me.Moveit.Text = "-->"
        '
        'lsKids
        '
        Me.lsKids.Location = New System.Drawing.Point(224, 48)
        Me.lsKids.Name = "lsKids"
        Me.lsKids.Size = New System.Drawing.Size(168, 186)
        Me.lsKids.TabIndex = 1
        '
        'Form1
        '
        Me.AutoScaleBaseSize = New System.Drawing.Size(5, 13)
        Me.ClientSize = New System.Drawing.Size(400, 301)
        Me.Controls.AddRange(New System.Windows.Forms.Control() {Me.Moveit, Me.lsKids, Me.lsNames})
        Me.Name = "Form1"
        Me.Text = "List Class Adapter demo"
        Me.ResumeLayout(False)

    End Sub

#End Region

End Class
