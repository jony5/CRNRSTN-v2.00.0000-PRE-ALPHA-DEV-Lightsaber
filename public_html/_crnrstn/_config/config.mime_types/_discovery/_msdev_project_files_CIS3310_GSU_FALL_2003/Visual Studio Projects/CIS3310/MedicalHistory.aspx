<%@ Page Language="vb" AutoEventWireup="false" Codebehind="MedicalHistory.aspx.vb" Inherits="cis3310.MedicalHistory"%>
<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Register TagPrefix="uc1" TagName="footer" Src="footer.ascx" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>MedicalHistory</title>
		<meta content="Microsoft Visual Studio .NET 7.1" name="GENERATOR">
		<meta content="Visual Basic .NET 7.1" name="CODE_LANGUAGE">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
		<LINK href="Styles.css" type="text/css" rel="stylesheet">
	</HEAD>
	<body>
		<form id="Form1" method="post" runat="server">
			<P>
				<uc1:ClinicHeader id="ClinicHeader1" runat="server"></uc1:ClinicHeader></P>
			<P><STRONG>Patient Medical History</STRONG></P>
			<P>Patient: <STRONG>England, Michael</STRONG></P>
			<P>
				<TABLE id="Table2" cellSpacing="1" cellPadding="4" border="0">
					<TR>
						<TD colSpan="4"><STRONG>Respiratory</STRONG></TD>
					</TR>
					<TR>
						<TD>Have you ever had pneumonia?</TD>
						<TD>
							<asp:RadioButtonList id="RadioButtonList4" runat="server" RepeatDirection="Horizontal" RepeatLayout="Flow">
								<asp:ListItem Value="Yes">Yes</asp:ListItem>
								<asp:ListItem Value="No">No</asp:ListItem>
							</asp:RadioButtonList></TD>
						<TD>List dates:</TD>
						<TD>
							<asp:TextBox id="TextBox1" runat="server" CssClass="TextBox"></asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Have you ever been short of breath?</TD>
						<TD>
							<asp:RadioButtonList id="RadioButtonList5" runat="server" RepeatDirection="Horizontal" RepeatLayout="Flow">
								<asp:ListItem Value="Yes">Yes</asp:ListItem>
								<asp:ListItem Value="No">No</asp:ListItem>
							</asp:RadioButtonList></TD>
						<TD>List dates:</TD>
						<TD>
							<asp:TextBox id="TextBox2" runat="server" CssClass="TextBox"></asp:TextBox></TD>
					</TR>
					<TR>
						<TD>Do you smoke?</TD>
						<TD>
							<asp:RadioButtonList id="RadioButtonList6" runat="server" RepeatDirection="Horizontal" RepeatLayout="Flow">
								<asp:ListItem Value="Yes">Yes</asp:ListItem>
								<asp:ListItem Value="No">No</asp:ListItem>
							</asp:RadioButtonList></TD>
						<TD>Packs per day:</TD>
						<TD>
							<asp:TextBox id="TextBox3" runat="server" CssClass="TextBox"></asp:TextBox></TD>
					</TR>
				</TABLE>
			</P>
			<P>...</P>
			<P>
				<asp:Button id="btnSave" runat="server" CssClass="button" Text="Save Changes" Width="120px"></asp:Button>&nbsp;
				<asp:Button id="btnCancel" runat="server" CssClass="Button" Text="Cancel Changes" Width="120px"></asp:Button></P>
			<P>
				<uc1:footer id="Footer1" runat="server"></uc1:footer></P>
		</form>
	</body>
</HTML>
