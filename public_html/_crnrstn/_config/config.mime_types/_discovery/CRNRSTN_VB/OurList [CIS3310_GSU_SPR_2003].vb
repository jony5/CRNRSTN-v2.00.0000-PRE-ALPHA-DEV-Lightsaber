Public Class OurList
    Inherits System.Windows.Forms.ListBox
    Implements ListAdapter

#Region " Windows Form Designer generated code "

    Public Sub New()
        MyBase.New()

        'This call is required by the Windows Form Designer.
        InitializeComponent()

        'Add any initialization after the InitializeComponent() call

    End Sub

    'UserControl overrides dispose to clean up the component list.
    Protected Overloads Overrides Sub Dispose(ByVal disposing As Boolean)
        If disposing Then
            If Not (components Is Nothing) Then
                components.Dispose()
            End If
        End If
        MyBase.Dispose(disposing)
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.Container

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()
        components = New System.ComponentModel.Container()
    End Sub

#End Region

    Public Sub addText(ByVal sw As ClassAdapter.Swimmer) Implements ClassAdapter.ListAdapter.addText
        Me.Items.Add(sw.getName & vbTab & sw.getTime.ToString)
    End Sub

    Public Sub addItem(ByVal s As String) Implements ClassAdapter.ListAdapter.addItem
        Me.Items.Add(s)
    End Sub

    Public Function ListIndex() As Integer Implements ClassAdapter.ListAdapter.ListIndex
        Return Me.SelectedIndex
    End Function
End Class
