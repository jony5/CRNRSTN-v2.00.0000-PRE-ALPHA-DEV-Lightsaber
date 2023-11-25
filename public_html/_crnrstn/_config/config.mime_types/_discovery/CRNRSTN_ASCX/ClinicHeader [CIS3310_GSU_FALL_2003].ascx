<%@ Control Language="vb" AutoEventWireup="false" Codebehind="ClinicHeader.ascx.vb" Inherits="cis3310.ClinicHeader" TargetSchema="http://schemas.microsoft.com/intellisense/ie5" %>
<TABLE id="Table1" cellSpacing="1" cellPadding="1" width="100%" border="0">
	<TR>
		<TD>Medical Office Administration System<BR>
			<STRONG>Dr. Susan Smith</STRONG></TD>
		<TD>
			<P align="right">
				<asp:Label id="lblUserName" runat="server">England, Michael</asp:Label>&nbsp;
				<asp:Button id="btnLogout" Text="Logout" runat="server" CssClass="Button"></asp:Button><BR>
				<asp:Label id="lblDate" runat="server"></asp:Label></P>
		</TD>
	</TR>
</TABLE>
<HR width="100%" SIZE="1">
