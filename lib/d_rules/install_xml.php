<?php

return [
    '2101:2302' => <<<EOF
    <file path="catalog/view/theme/*/template/product/category.tpl">
        <operation>
          <search trim="true">
            <![CDATA[\$results]]>
          </search>
          <add position="replace" trim="false">
            <![CDATA['<span id="pagination-text">' . \$results . '</span>']]>
          </add>
        </operation>

        <operation>
          <search trim="true">
            <![CDATA[\$pagination]]>
          </search>
          <add position="replace" trim="false">
            <![CDATA['<span id="products-pagination">' . \$pagination . '</span>']]>
          </add>
        </operation>
  </file>
EOF,
    '3000:3020' => <<<EOF
    <file path="catalog/view/theme/*/template/product/category.twig">
      <operation>
         <search trim="true"><![CDATA[{{ results }}]]></search>
         <add position="replace" trim="false"><![CDATA[<span id="pagination-text">{{ results }}</span>]]></add>
      </operation>
      <operation>
         <search trim="true"><![CDATA[{{ pagination }}]]></search>
         <add position="replace" trim="false"><![CDATA[<span id="products-pagination">{{ pagination }}</span>]]></add>
      </operation>
   </file>
EOF
];