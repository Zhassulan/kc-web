<?xml version="1.0" encoding="Windows-1251"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:decimal-format decimal-separator="." grouping-separator="," />

  <xsl:template match="/">
    <html>

      <head>
        <title>
          <xsl:value-of select="/Receiver/@Id" />: <xsl:value-of select="/Receiver/Report/@Desc" /> за <xsl:value-of select="/Receiver/@DateTo" />
        </title>
        <style>

			td
			{
			padding-top:1px;
			padding-right:3px;
			padding-bottom:1px;
			padding-left:3px;
			white-space:nowrap;
			}

			.np
			{
			padding-top:0px;
			padding-right:0px;
			padding-bottom:1px;
			padding-left:0px;
			}

			.sign1
			{
			font-size:7.0pt;
			font-weight:100;
			font-family:"Arial CYR", sans-serif;
			color:gray;
			text-align:center;
			vertical-align:bottom;
			white-space:normal;
			letter-spacing:2pt;
			}

			.sign2
			{
			font-size:7.0pt;
			font-weight:100;
			font-family:"Arial CYR", sans-serif;
			color:gray;
			text-align:center;
			vertical-align:top;
			white-space:normal;
			letter-spacing:2pt;
			}

			.sign3
			{
			color:gray;
			text-align:justify;
			vertical-align:top;
			border-top:.5pt solid gray;
			}

			.sign4
			{
			color:gray;
			text-align:left;
			vertical-align:middle;
			white-space:normal;
			}

			.sign5
			{
			color:gray;
			text-align:right;
			vertical-align:middle;
			white-space:normal;
			}
			.sign6
			{
			font-size:9.0pt;
			font-weight:100;
			font-family:"Arial CYR", sans-serif;
			<!--color:gray;-->
			text-align:left;
			vertical-align:bottom;
			white-space:normal;
			letter-spacing:1pt;
			}

			.hdr01
			{
			font-size:8.0pt;
			font-weight:100;
			font-family:"Arial CYR", sans-serif;
			color:#315D84;
			text-align:center;
			vertical-align:middle;
			border-top:.5pt solid windowtext;
			border-right:.5pt solid windowtext;
			border-bottom:.5pt solid windowtext;
			border-left:.5pt solid windowtext;
			background:#E7F2F4;
			white-space:normal;
			}

			.dat01
			{
			font-size:7.0pt;
			font-weight:700;
			font-family:"Courier New CYR", monospace;
			letter-spacing:.5pt;
			text-align:center;
			vertical-align:middle;
			border-top:.5pt solid windowtext;
			border-right:.5pt solid windowtext;
			border-bottom:.5pt solid windowtext;
			border-left:.5pt solid windowtext;
			mso-number-format:'\@';
			}

			.dat01_l
			{
			font-size:7.0pt;
			font-weight:700;
			font-family:"Courier New CYR", monospace;
			letter-spacing:.5pt;
			text-align:left;
			vertical-align:middle;
			border-top:.5pt solid windowtext;
			border-right:.5pt solid windowtext;
			border-bottom:.5pt solid windowtext;
			border-left:.5pt solid windowtext;
			}

			.dat01_r
			{
			font-size:7.0pt;
			font-weight:700;
			font-family:"Courier New CYR", monospace;
			letter-spacing:.5pt;
			text-align:right;
			vertical-align:middle;
			border-top:.5pt solid windowtext;
			border-right:.5pt solid windowtext;
			border-bottom:.5pt solid windowtext;
			border-left:.5pt solid windowtext;
			}

			.dat02
			{
			font-size:7.0pt;
			font-weight:700;
			font-family:"Courier New CYR", monospace;
			letter-spacing:.5pt;
			text-align:left;
			vertical-align:middle;
			border-top:.5pt solid windowtext;
			border-right:.5pt solid windowtext;
			border-bottom:.5pt solid windowtext;
			border-left:.5pt solid windowtext;
			}

			.dat02L
			{
			font-size:8.0pt;
			font-weight:700;
			font-family:"Courier New CYR", monospace;
			letter-spacing:.5pt;
			text-align:left;
			vertical-align:middle;
			border-top:.5pt solid windowtext;
			border-right:.5pt solid windowtext;
			border-bottom:.5pt solid windowtext;
			border-left:.5pt solid windowtext;
			}

		</style>

      </head>

      <body>
        <xsl:apply-templates />
      </body>

    </html>
  </xsl:template>

  <xsl:template match="Receiver">
    <xsl:element name="table">

      <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

      <tr>
        <td class="np" colSpan="7">

          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

            <col />
            <col width="100%" />
            <col />

            <tr>

              <td class="sign4" rowspan="2"><img src="https://kc-ets.kz/docs/schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>

              <td class="sign1">Данный документ передан в электронном виде и подписан электронной цифровой подписью</td>

              <td class="sign5" rowspan="2"><img src="https://kc-ets.kz/docs/schema/ets001.jpg" width="105" height="25" alt="submit"></img></td>

            </tr>

            <tr>
          <td class="sign2">Товарищества с ограниченной ответственностью "Клиринговый центр ЕТС""</td>
            </tr>

           <tr height="4" >
             <td class="np"></td>
           </tr>

            <tr height="20">
          <td class="sign3" colspan="3"></td>
            </tr>

          </xsl:element>

    </td>
      </tr>

      <tr>
        <td class="np" colspan="7">
          <xsl:element name="table">
            <xsl:attribute name="style">border-collapse:collapse;</xsl:attribute>

            <col width="20%" />
            <col />
            <col width="100%"/>
            <col />
            <col />

            <tr>
              <td class="hdr01" colspan="5">Товарищество с ограниченной ответственностью "Клиринговый центр ЕТС"</td>
            </tr>
            <tr>
              <td class="dat02L" colspan="5">
                <xsl:value-of select="Report/@Desc" />
              </td>
            </tr>
            <tr>
              <td class="hdr01">Участник клиринга</td>
              <td class="dat02">
                <xsl:value-of select="@Id" />
              </td>
              <td class="dat02" colspan="3">
                <xsl:value-of select="@Name" />
              </td>
            </tr>
            <tr>
              <td class="hdr01">Дата отчета</td>
              <td class="dat02">
                <xsl:value-of select="@DateTo" />
              </td>
              <td class="dat02"></td>
              <td class="hdr01">Сформирован</td>
              <td class="dat02">
                <xsl:value-of select="@DateRpt" />
              </td>
            </tr>

          </xsl:element>
        </td>
      </tr>

      <tr height="8" >
        <td colSpan="1" class="np"></td>
      </tr>

      <tr>
        <td class="hdr01" rowspan="2" >№</td>
        <td class="hdr01" rowspan="2" >Код торгового счета</td>
        <td class="hdr01" rowspan="2" >БИН</td>
        <td class="hdr01" rowspan="2" >Наименование</td>
        <td class="hdr01" colspan="4" >Клиринговые регистры учета</td>
        <td class="hdr01" rowspan="2" >Дата регистрации</td>
        <td class="hdr01" rowspan="2" >Дата удаления</td>
        <td class="hdr01" rowspan="2" >Активность</td>
        <td class="hdr01" rowspan="2" >Примечание</td>
      </tr>
      <tr>
        <td class="hdr01">Оплата</td>
        <td class="hdr01">ГО ДВАА</td>
        <td class="hdr01">Депо</td>
        <td class="hdr01">ГО Спец</td>
      </tr>



      <xsl:apply-templates select="SettlPairGroup"/>
    </xsl:element>
	  <xsl:element name="table">
		  <tr height="70">
			  <td class="sign6" colspan="8">Генеральный Директор ТОО "Клиринговый центр  "ЕТС"</td>
			  <td class="sign6" colspan="3">А. Т. Уристембаева</td>
		  </tr>
		  <tr height="40"></tr>
		  <tr>
			  <td class="sign6" colspan="3">
				  Заместителя начальника
				  Управления расчетно-клиринговых систем</td>
			  <td class="sign6" colspan="5"></td>
			  <td class="sign6" colspan="3">Р.К. Енсепбаева</td>
		  </tr>
	  </xsl:element>
  </xsl:template>

  <xsl:template match="SettlPairGroup">
    <xsl:apply-templates select="Client"/>
  </xsl:template>


  <xsl:template match="Client">
    <tr>
      <td class="dat01">
        <xsl:value-of select="@Num" />
      </td>

      <td class="dat01">
        <xsl:value-of select="@ClientCode" />
      </td>
      <xsl:choose>
    <xsl:when test="../SettlPair/@NoAccounts[.='1']">
      <td class="dat01" ></td>
      <td class="dat01" ></td>
      <td class="dat01" ></td>
      <td class="dat01" ></td>
        </xsl:when>
        <xsl:otherwise>
          <xsl:apply-templates select="../SettlPair/Account"/>
        </xsl:otherwise>
      </xsl:choose>

      <td class="dat01">
        <xsl:value-of select="@Inn" />
      </td>
      <td class="dat01_l">
        <xsl:value-of select="@ClientName" />
      </td>
       <td class="dat01_l">
        <xsl:value-of select="@DelivAcc" />
      </td>
      <td class="dat01_l">
        <xsl:value-of select="@GarantAcc" />
      </td>
      <td class="dat01_l">
        <xsl:value-of select="@DepoAcc" />
      </td>
      <td class="dat01_l">
        <xsl:value-of select="@SpecAcc" />
      </td>

       <td class="dat01">
        <xsl:value-of select="@CreateMoment" />
      </td>
      <td class="dat01">
        <xsl:value-of select="@DeleteMoment" />
      </td>

      <td class="dat01">
        <xsl:choose>
         <xsl:when test="@IsDel[.='1']">
            <xsl:text>удален</xsl:text>
          </xsl:when>
          <xsl:when test="@IsDel[.='0']">
            <xsl:text>активен</xsl:text>
          </xsl:when>
        </xsl:choose>

      </td>
      <td class="dat01">
        <xsl:value-of select="@Memo" />
      </td>

    </tr>

  </xsl:template>
	
		
	

  <xsl:template match="SettlPair/Account">
    <td class="dat01"><xsl:value-of select="@OrgCode" /></td>
    <td class="dat01"><xsl:value-of select="@AccCode" /></td>
  </xsl:template>
	

</xsl:stylesheet>