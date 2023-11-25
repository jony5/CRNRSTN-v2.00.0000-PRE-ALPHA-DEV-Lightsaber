<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="xml" indent="yes"
	doctype-public="-//W3C//DTD SVG 1.0//EN"
	doctype-system="http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd"/>
<xsl:key name="category" match="nutrition/daily-values/*"
	use="local-name()"/>

<xsl:template match="nutrition">
<xsl:variable name="n">
	<xsl:choose>
	<xsl:when test="count(food)*25+40 &lt; 400">400</xsl:when>
	<xsl:otherwise>
		<xsl:value-of select="count(food)*25 + 40"/>
	</xsl:otherwise>
	</xsl:choose>
</xsl:variable>
<svg width="600" height="{$n}"
	viewBox="0 0 600 0 {$n}">

<script type="text/ecmascript">
<![CDATA[
var currId = "0";

function show( id )
{
	var obj;
	if (id != currId)
	{
		obj = document.getElementById( "graph" + currId );
		obj.setAttribute( "visibility", "hidden");
		if (currId != 0)
		{
			obj = document.getElementById( "rect" + currId );
			obj.setAttribute( "fill", "#eeeeff" );
		}
		obj = document.getElementById( "graph" + id );
		obj.setAttribute( "visibility", "visible");
		obj = document.getElementById( "rect" + id );
		obj.setAttribute( "fill", "#ffff00");
		currId = id;
	}
}
// ]]>
</script>

<xsl:comment>Draw axes</xsl:comment>
<g transform="translate(40,20)">
<path d="M0 0 L0 200 200 200 
	M -3 0 h6 M -3 20 h6 M -3 40 h6 M -3 60 h6
	M -3 80 h6 M -3 100 h6 M -3 120 h6 M -3 140 h6
	M -3 160 h6 M -3 180 h6" style="stroke:black; fill:none;"/>
	<g style="font-size: 8pt; text-anchor:end">
	<text x="-5" y="5">100%</text>
	<text x="-5" y="45">80%</text>
	<text x="-5" y="85">60%</text>
	<text x="-5" y="125">40%</text>
	<text x="-5" y="165">20%</text>
	<text x="-5" y="205">0%</text>
	</g>
	<g style="font-size: 8pt; writing-mode: tb;">
	<text x="25" y="205">Total Fat</text>
	<text x="75" y="205">Sat. Fat</text>
	<text x="125" y="205">Cholesterol</text>
	<text x="175" y="205">Sodium</text>
	</g>
</g>

<xsl:comment>Preliminary instructions</xsl:comment>
<g transform="translate(40,20)" id="graph0">
	<text x="50" y="50">Click a food to see
		<tspan x="50" y="70">its data.</tspan></text>
</g>

<xsl:apply-templates select="food"/>

</svg>
</xsl:template>

<xsl:template match="food">
	<xsl:comment>Display the name of the food</xsl:comment>
	<g onclick="show({position()})">
	<rect id="rect{position()}"
		x="300" width="250" height="20" fill="#eeeeff"
		style="stroke:black;">
		<xsl:attribute name="y"><xsl:value-of
			select="(position() * 25) - 15"/></xsl:attribute>
	</rect>
	<text x="425" style="font-size: 10pt; text-anchor:middle;">
		<xsl:attribute name="y"><xsl:value-of
			select="(position() * 25) - 15 + 14"/></xsl:attribute>
		<xsl:value-of select="name"/>
   	</text>
	</g>
	
	<xsl:comment>Create a hidden graph for that food</xsl:comment>
	<g id="graph{position()}" visibility="hidden"
		transform="translate(40,20)">
	<xsl:call-template name="draw-bar">
		<xsl:with-param name="number" select="0"/>
		<xsl:with-param name="node" select="total-fat"/>
	</xsl:call-template>

	<xsl:call-template name="draw-bar">
		<xsl:with-param name="number" select="1"/>
		<xsl:with-param name="node" select="saturated-fat"/>
	</xsl:call-template>

	<xsl:call-template name="draw-bar">
		<xsl:with-param name="number" select="2"/>
		<xsl:with-param name="node" select="cholesterol"/>
	</xsl:call-template>

	<xsl:call-template name="draw-bar">
		<xsl:with-param name="number" select="3"/>
		<xsl:with-param name="node" select="sodium"/>
	</xsl:call-template>
	</g>	
</xsl:template>

<xsl:template name="draw-bar">
<xsl:param name="number"/>
<xsl:param name="node"/>

<xsl:variable name="pct">
	<xsl:value-of
	select="round(100 * $node div key('category',name($node)))"/>
</xsl:variable>

<rect width="25">
	<xsl:attribute name="x"><xsl:value-of
		select="12.5 + $number*50"/></xsl:attribute>
	<xsl:attribute name="y"><xsl:value-of
		select="200 - $pct*2"/></xsl:attribute>
	<xsl:attribute name="height"><xsl:value-of
		select="$pct * 2"/></xsl:attribute>
	<xsl:choose>
	<xsl:when test="$pct &lt;= 50">
		<xsl:attribute name="style">fill:green;</xsl:attribute>
	</xsl:when>
	<xsl:otherwise>
		<xsl:attribute name="style">fill:red;</xsl:attribute>
	</xsl:otherwise>
	</xsl:choose>
</rect>
	
<text style="font-size:8pt; text-anchor: middle;">
	<xsl:attribute name="x"><xsl:value-of
		select="25 + $number * 50"/></xsl:attribute>
	<xsl:attribute name="y"><xsl:value-of
		select="195 - $pct*2"/></xsl:attribute>
	<xsl:value-of select="$pct"/><xsl:text>%</xsl:text>
</text>

</xsl:template>

</xsl:stylesheet>
