<%@ Page Language="vb" AutoEventWireup="false" Codebehind="HistoryMaintenance.aspx.vb" Inherits="cis3310.HistoryMaintenance"%>
<%@ Register TagPrefix="uc1" TagName="ClinicHeader" Src="ClinicHeader.ascx" %>
<%@ Register TagPrefix="uc1" TagName="footer" Src="footer.ascx" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>HistoryMaintenance</title>
		<meta name="GENERATOR" content="Microsoft Visual Studio .NET 7.1">
		<meta name="CODE_LANGUAGE" content="Visual Basic .NET 7.1">
		<meta name="vs_defaultClientScript" content="JavaScript">
		<meta name="vs_targetSchema" content="http://schemas.microsoft.com/intellisense/ie5">
		<link href="Styles.css" rel="stylesheet" type="text/css">
	</HEAD>
	<body>
		<form id="Form1" method="post" runat="server">
			<P>
				<uc1:ClinicHeader id="ClinicHeader1" runat="server"></uc1:ClinicHeader></P>
			<P>History Question Maintenance</P>
			<P>Select Category:
				<asp:DropDownList id="DropDownList1" runat="server">
					<asp:ListItem Value="Respiratory">Respiratory</asp:ListItem>
					<asp:ListItem Value="Surgery">Surgery</asp:ListItem>
					<asp:ListItem Value="Gynegological">Gynegological</asp:ListItem>
					<asp:ListItem Value="Add New Category">Add New Category</asp:ListItem>
				</asp:DropDownList></P>
			<P>Category: <STRONG>Respiratory</STRONG></P>
			<P>
				<TABLE id="Table1" cellSpacing="1" cellPadding="1" border="0">
					<TR>
						<TD width="100">Action</TD>
						<TD style="WIDTH: 263px">Question</TD>
						<TD style="WIDTH: 263px">Note Prompt</TD>
						<TD align="center" colSpan="2">
							<P align="center">Order</P>
						</TD>
					</TR>
					<TR>
						<TD width="100">
							<asp:Button id="Button6" runat="server" Text="Edit" CssClass="Button" Width="25px"></asp:Button>
							<asp:Button id="Button7" runat="server" Text="Del" CssClass="Button" Width="25px"></asp:Button></TD>
						<TD style="WIDTH: 263px">
							<asp:TextBox id="TextBox2" runat="server" Width="248px">Have you ever had pneumonia?</asp:TextBox></TD>
						<TD>
							<asp:TextBox id="TextBox1" runat="server">List dates:</asp:TextBox></TD>
						<TD align="center" width="50">
							<asp:Button id="Button1" runat="server" Text="Up" CssClass="Button" Width="40px" Enabled="False"></asp:Button></TD>
						<TD align="center" width="50">
							<asp:Button id="btnDown" runat="server" Text="Down" CssClass="Button" Width="40px"></asp:Button></TD>
					</TR>
					<TR>
						<TD width="100">
							<asp:Button id="Button9" runat="server" Text="Edit" CssClass="Button" Width="25px"></asp:Button>
							<asp:Button id="Button8" runat="server" Text="Del" CssClass="Button" Width="25px"></asp:Button></TD>
						<TD style="WIDTH: 263px">
							<asp:TextBox id="TextBox3" runat="server" Width="248px">Have you ever been short of breath?</asp:TextBox></TD>
						<TD>
							<asp:TextBox id="TextBox4" runat="server">List dates:</asp:TextBox></TD>
						<TD align="center" width="50">
							<asp:Button id="Button3" runat="server" Text="Up" CssClass="Button" Width="40px"></asp:Button></TD>
						<TD align="center" width="50">
							<asp:Button id="Button2" runat="server" Text="Down" CssClass="Button" Width="40px"></asp:Button></TD>
					</TR>
					<TR>
						<TD width="100">
							<asp:Button id="Button11" runat="server" Text="Edit" CssClass="Button" Width="25px"></asp:Button>
							<asp:Button id="Button10" runat="server" Text="Del" CssClass="Button" Width="25px"></asp:Button></TD>
						<TD style="WIDTH: 263px">
							<asp:TextBox id="TextBox5" runat="server" Width="248px">Do you smoke?</asp:TextBox></TD>
						<TD>
							<asp:TextBox id="TextBox6" runat="server">Packs per day:</asp:TextBox></TD>
						<TD align="center" width="50">
							<asp:Button id="Button4" runat="server" Text="Up" CssClass="Button" Width="40px"></asp:Button></TD>
						<TD align="center" width="50">
							<asp:Button id="Button5" runat="server" Text="Down" CssClass="Button" Width="40px" Enabled="False"></asp:Button></TD>
					</TR>
				</TABLE>
			</P>
			<P>
				<uc1:footer id="Footer1" runat="server"></uc1:footer></P>
		</form>
	</body>
</HTML>
