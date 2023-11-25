Public Interface ListAdapter
    'Interface Adapter for ListBox emulating some of
    'the methods of the VB6 list box.
    Sub addItem(ByVal s As String)
    Function ListIndex() As Integer
    Sub addText(ByVal sw As Swimmer)
End Interface
