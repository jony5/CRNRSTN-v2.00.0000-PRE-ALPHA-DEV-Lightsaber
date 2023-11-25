<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:fo="http://www.w3.org/1999/XSL/Format">

<xsl:output method="xml" indent="yes"/>
<xsl:key name="category" match="nutrition/daily-values/*"
	use="local-name()"/>
<xsl:template match="nutrition">
<fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">

    <fo:layout-master-set>
		<fo:simple-page-master master-name="cover"
            page-height="10cm"
            page-width="8cm"
            margin-top="0.25cm"
            margin-bottom="0.25cm"
            margin-left="0.5cm"
            margin-right="0.25cm">
            <fo:region-body
                margin-top="0.3cm" />
		</fo:simple-page-master>

       <fo:simple-page-master master-name="leftPage"
            page-height="10cm"
            page-width="8cm"
            margin-left="0.25cm"
            margin-right="0.5cm"
            margin-top="0.25cm"
            margin-bottom="0.25cm">
            <fo:region-after extent="0.5cm"/>
            <fo:region-body
                margin-top="0.25cm"
                margin-bottom="0.25cm" />
        </fo:simple-page-master>

        <fo:simple-page-master master-name="rightPage"
            page-height="10cm"
            page-width="8cm"
            margin-left="0.5cm"
            margin-right="0.25cm"
            margin-top="0.25cm"
            margin-bottom="0.25cm">
            <fo:region-after extent="0.5cm"/>
            <fo:region-body
                margin-top="0.25cm"
                margin-bottom="0.25cm" />
        </fo:simple-page-master>

        <xsl:comment>Set up the sequence of pages</xsl:comment>
        <fo:page-sequence-master master-name="contents">
            <fo:repeatable-page-master-alternatives>
                <fo:conditional-page-master-reference
                    master-reference="leftPage"
                    odd-or-even="even"/>
                <fo:conditional-page-master-reference
                    master-reference="rightPage"
                    odd-or-even="odd"/>
            </fo:repeatable-page-master-alternatives>
        </fo:page-sequence-master>
    </fo:layout-master-set>

    <fo:page-sequence master-reference="cover">
    <fo:flow flow-name="xsl-region-body">
        <fo:block font-family="Helvetica" font-size="18pt"
            text-align="end" space-before="2cm"> 
            Nutrition Facts
        </fo:block>
        <fo:block font-family="Helvetica" font-size="12pt"
            text-align="end">
            for Selected Foods
        </fo:block>
		<xsl:comment>Inside front cover is blank</xsl:comment>
		<fo:block break-before="page"> </fo:block>
    </fo:flow>
    </fo:page-sequence>

    <fo:page-sequence master-reference="contents"
		initial-page-number="1">

    <fo:static-content flow-name="xsl-region-after">
        <fo:block font-family="Helvetica" font-size="9pt"
            text-align="center">
            - <fo:page-number /> -
        </fo:block>
    </fo:static-content>

    <fo:flow flow-name="xsl-region-body">
		<fo:block font-family="Helvetica" font-size="9pt">
    		<xsl:apply-templates select="food"/>
		</fo:block>

		<fo:block break-before="page"
			font-size="12pt" text-align="center">Notes</fo:block>
    </fo:flow>
    </fo:page-sequence>
</fo:root>
</xsl:template>

<xsl:template match="food">
	<fo:block font-size="12pt" font-weight="bold">
	   <xsl:value-of select="mfr"/><xsl:text> </xsl:text>
	   <xsl:value-of select="name"/>
	</fo:block>
   
	<fo:block>
		Serving size: <xsl:value-of select="serving"/>
		<xsl:text> </xsl:text>
		<xsl:value-of select="serving/@units"/>
	</fo:block>
	
   	<xsl:call-template name="thick-line"/>

	<fo:block font-weight="bold">Amount/Serving</fo:block>
	
	<fo:block>
		Calories: <xsl:value-of select="calories/@total"/>
		&#183;
		Fat Calories: <xsl:value-of select="calories/@fat"/>
	</fo:block>
   	
	<xsl:call-template name="thick-line"/>
	
	<fo:table table-layout="fixed"
		inline-progression-dimension.maximum="100%">
		<fo:table-column width="5cm"/>
		<fo:table-column width="1cm"/>

		<fo:table-body>
			<fo:table-row>
				<fo:table-cell padding-top="1pt" padding-bottom="1pt"
					border-bottom-style="solid"
					border-bottom-width="1px">
					<fo:block> </fo:block>
				</fo:table-cell>
				<fo:table-cell padding-top="1pt" padding-bottom="1pt"
					border-bottom-style="solid"
					border-bottom-width="1px">
					<fo:block text-align="end">% Daily Value</fo:block>
				</fo:table-cell>
			</fo:table-row>

			<xsl:call-template name="info-row">
				<xsl:with-param name="msg">Total Fat</xsl:with-param>
				<xsl:with-param name="node" select="total-fat"/>
			</xsl:call-template>

			<xsl:call-template name="info-row">
				<xsl:with-param
					name="msg"> Saturated Fat</xsl:with-param>
				<xsl:with-param name="node" select="saturated-fat"/>
			</xsl:call-template>

			<xsl:call-template name="info-row">
				<xsl:with-param name="msg">Cholesterol</xsl:with-param>
				<xsl:with-param name="node" select="cholesterol"/>
			</xsl:call-template>

			<xsl:call-template name="info-row">
				<xsl:with-param name="msg">Sodium</xsl:with-param>
				<xsl:with-param name="node" select="sodium"/>
			</xsl:call-template>

			<xsl:call-template name="info-row">
				<xsl:with-param
					name="msg">Total Carbohydrates</xsl:with-param>
				<xsl:with-param name="node" select="carb"/>
			</xsl:call-template>

			<xsl:call-template name="info-row">
				<xsl:with-param
					name="msg">Dietary Fiber</xsl:with-param>
				<xsl:with-param name="node" select="fiber"/>
			</xsl:call-template>

			<xsl:call-template name="info-row">
				<xsl:with-param name="msg">Protein</xsl:with-param>
				<xsl:with-param name="node" select="protein"/>
			</xsl:call-template>
		</fo:table-body>
	</fo:table>

	<fo:block space-before="6pt" text-align="center">
		Vitamin A <xsl:value-of select="vitamins/a"/>%
		<xsl:text disable-output-escaping="yes">&#183;</xsl:text>
		Vitamin C <xsl:value-of select="vitamins/c"/>%
	</fo:block>
	<fo:block text-align="center">
		<xsl:if test="position()!=last()">
			<xsl:attribute  name="break-after">page</xsl:attribute>
		</xsl:if>
		Calcium <xsl:value-of select="minerals/ca"/>%
		<xsl:text disable-output-escaping="yes">&#183;</xsl:text>
		Iron <xsl:value-of select="minerals/fe"/>%
	</fo:block>
	
</xsl:template>

<xsl:template name="thick-line">
	<fo:block space-before="0px">
   		<fo:leader leader-pattern="rule"
			leader-length="100%"
			rule-style="solid"
			rule-thickness="0.1cm"/>
	</fo:block>
</xsl:template>

<xsl:template name="info-row">
<xsl:param name="msg"/>
<xsl:param name="node"/>
<fo:table-row>
	<fo:table-cell>
		<fo:block padding-top="1pt" padding-bottom="1pt"
			border-bottom-style="solid"
			border-bottom-width="1px">
			<xsl:value-of select="$msg"/>
			<xsl:text> </xsl:text>
			<xsl:value-of select="$node"/>
			<xsl:value-of select="key('category',name($node))/@units"/>
		</fo:block>
	</fo:table-cell>
	<fo:table-cell>
		<fo:block text-align="end"
			padding-top="1pt" padding-bottom="1pt"
			border-bottom-style="solid"
			border-bottom-width="1px">
			<xsl:value-of select="round(100 * $node div
				key('category',name($node)))"/>
			<xsl:text>%</xsl:text>
		</fo:block>
	</fo:table-cell>
</fo:table-row>
</xsl:template>

</xsl:stylesheet>
