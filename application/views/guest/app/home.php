<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="kt-portlet" id="kt_portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon-calendar"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Kalender Kegiatan
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                    </div>
                </div>
                <div class="kt-portlet__body">
					<div id="kalender">
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<link href='<?= base_url(); ?>assets/css/fullcalendar.css' rel='stylesheet' />

<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <form class="form-horizontal" >
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Detil Jadwal Kegiatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            
            <div class="form-group">
                <label for="title" class="col-sm-12 control-label">Direktorat</label>
                <div class="col-sm-12">
                <input type="text" name="direktorat" class="form-control" id="direktorat" placeholder="Direktorat">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-12 control-label">Sub-Direktorat</label>
                <div class="col-sm-12">
                <input type="text" name="subdirektorat" class="form-control" id="subdirektorat" placeholder="Sub-Direktorat">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-12 control-label">Kegiatan</label>
                <div class="col-sm-12">
                <input type="text" name="title" class="form-control" id="title" placeholder="Nama Kegiatan">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-12 control-label">Tanggal</label>
                <div class="col-sm-12">
                <input type="datetime-local" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal Kegiatan">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-12 control-label">Lokasi</label>
                <div class="col-sm-12">
                <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Lokasi Penyelenggaraan">
                </div>
            </div>
            <div class="form-group">
                <label for="title" class="col-sm-12 control-label">Peserta</label>
                <div class="col-sm-12">
                <input type="text" name="peserta" class="form-control" id="peserta" placeholder="Sasaran Peserta">
                </div>
            </div>
            
            <input type="hidden" name="id" class="form-control" id="id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        </div>
    </form>
    </div>
    </div>
</div>
<style>
.fc-icon-left-single-arrow {
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAgAElEQVR4Xu3daej3ezoH8LclOZQiMjzAeGDfSiLZztib7KUs4VAyD5Q1FGPs0VgeyBIJx5KyTXbCiCzhiW2GLMkyx1CUTEMO+h73/5wz9/b/Ld/lc32u13n8+32/1+f1/sxc7/O/73PfrxX/ECBAgAABAu0EXqvdiR2YAAECBAgQiALgEhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZAAECBAgoAO4AAQIECBBoKKAANAzdkQkQIECAgALgDhAgQIAAgYYCCkDD0B2ZwAkCr53k7ZK8TZLXSfJEkj9J8p8nfNdHjhN4/STvkuTNk/x3kr9J8pdJ/ue4kbx5VAEFYNRkzEXgGIE3SfJFSR5L8py7RnhVkp9M8vVJXnbMeN76AIFl6X9Zko9L8shdn/nHJN+X5FuS/CtBAjcCCoC7QIDAjcDzk3x/kje9hWT5N8sXJfkG/2Z5+OVZflLzwiRffucnNQ8b6JVJPi3JLx0+tQGGEFAAhojBEAQOF/jMJN+b5Jz/T/iBJJ+V5MnDp+85wOveKWyfcsbxl18KWH6684NnfMdHJxU453/skxI4FoH2Apcs/xu0x+8sFCVg32u0LP+lgH3yBa/93zuZLd/3T2MBBaBx+I5OIMk1y18JOOYKXbP8byZWAo7Jbqi3KgBDxWEYArsKrLH8lYBdI8say18J2DezYd+mAAwbjcEIbCqw5vJXAjaN6umHr7n8lYB9Mhv6LQrA0PEYjsAmAlss/5tBfyjJZ/iNgavntsXyVwJWj6nWAxWAWnmZlsC1AlsufyXg2nTu//0tl78SsE1mJZ6qAJSIyZAEVhHYY/krAatEtemP/R80od8YuG52wz9NARg+IgMSWEVgz+V/M/APJ/l0vxxwcX57/Jv/3cMpARfHVe+LCkC9zExM4FyBI5a/EnBuSq/5+SOWv18OuC6zct9WAMpFZmACZwkcufyVgLOiOuTH/n454LKMpviWAjBFjA5B4L4CIyx/JeC8y3nkv/n75YDzsir/aQWgfIQOQGD45X8z4I/c+cto/LHB97+0Iy1/vxzQ4P9YFIAGITtiO4GR/s3/bnwloM7yVwIm/78OBWDygB2vncDIy//ZPwlY/uuA5a8V9k9W/eN9t/L0XwdsJXvgcxWAA/G9msDKAhWW/82RvzvJ56x8/oqPG/HH/g9yXErAxyf56YrQZr5XQAFwKwjMIVBp+d+IL3+P/fJLAl3/qbT8bzL69yTvmuRvu4Y207kVgJnSdJauAhWX/5LVK5K8bZJXNwyu4vK/iWkpbUt5809xAQWgeIDGby9QdfnfBPfJSX60WYqVl/8S1fJfcbxlklc2y2264yoA00XqQI0Eqi//JaofvPPHBXeJrfry71zcprujCsB0kTpQE4EZlv8S1R8kea8mmc2y/Je4vjbJVzTJbdpjKgDTRutgEwvMsvyXiF6e5B0nzurmaDMt/+VM35bk8xvkNvURFYCp43W4CQVmWv5LPL+T5H0nzOnZR5pt+S9n+8okXz15btMfTwGYPmIHnEhgtuW/RPNdSV4wUUZ3H2XG5b+c8WOTvGTi3FocTQFoEbNDTiAw4/JfYnl+kp+fIJ/7HWHW5f+qJM9JsvyZAP4pLKAAFA7P6G0EZl3+f5bk3e78Z2WzhTnr8l9y8uv/k9xWBWCSIB1jWoFZl//yx8o+muQ3Jkxu5uX/93f+JMB/mzC3dkdSANpF7sCFBGZd/ksEX5zkxYWyOHXUmZf/f9wpbb9/KobPjS2gAIydj+n6Csy8/L8qyYsmjHbm5b/8uv/y+zVeOmFubY+kALSN3sEHFrD8Bw7nAaNZ/vUyaz+xAtD+CgAYTMDyHyyQE8ax/E9A8pHxBBSA8TIxUV8By79e9pZ/vcxMfEdAAXAVCIwhYPmPkcM5U1j+52j57HACCsBwkRiooYDlXy90y79eZia+S0ABcCUIHCtg+R/rf8nbLf9L1HxnOAEFYLhIDNRIwPKvF7blXy8zEz9AQAFwNQgcI2D5H+N+zVst/2v0fHc4AQVguEgM1EDA8q8XsuVfLzMT3yKgALgiBPYVsPz39V7jbZb/GoqeMZyAAjBcJAaaWMDyrxeu5V8vMxOfKKAAnAjlYwSuFLD8rwQ84OuW/wHoXrmfgAKwn7U39RWw/Otlb/nXy8zEZwooAGeC+TiBMwUs/zPBBvi45T9ACEbYXkAB2N7YG/oKWP71srf862Vm4gsFFIAL4XyNwC0Cln+9K2L518vMxFcIKABX4PkqgQcIWP71roblXy8zE18poABcCejrBO4SsPzrXQnLv15mJl5BQAFYAdEjCNwRsPzrXQXLv15mJl5JQAFYCdJj2gtY/vWugOVfLzMTryigAKyI6VFtBSz/etFb/vUyM/HKAgrAyqAe107A8q8XueVfLzMTbyCgAGyA6pFtBCz/elFb/vUyM/FGAgrARrAeO72A5V8vYsu/XmYm3lBAAdgQ16OnFbD860Vr+dfLzMQbCygAGwN7/HQCln+9SC3/epmZeAcBBWAHZK+YRsDyrxel5V8vMxPvJKAA7ATtNeUFZl7+L0ryVeUTuvcAlv+EoTrSegIKwHqWnjSvgOVfL1vLv15mJt5ZQAHYGdzryglY/uUii+VfLzMTHyCgAByA7pVlBCz/MlE9PajlXy8zEx8koAAcBO+1wwtY/sNHdM+Aln+9zEx8oIACcCC+Vw8rYPkPG80DB7P862Vm4oMFFICDA/D64QQs/+EiuXUgy/9WIh8gcK+AAuBWEHhGwPKvdxss/3qZmXgQAQVgkCCMcbiA5X94BGcPYPmfTeYLBJ4RUADcBgKJ5V/vFlj+9TIz8WACCsBggRhndwHLf3fyq19o+V9N6AEEEgXALegsYPnXS9/yr5eZiQcVUAAGDcZYmwtY/psTr/4Cy391Ug/sLKAAdE6/79kt/3rZW/71MjPx4AIKwOABGW91Act/ddLNH2j5b07sBR0FFICOqfc9s+VfL3vLv15mJi4ioAAUCcqYVwtY/lcT7v4Ay393ci/sJKAAdEq771kt/3rZW/71MjNxMQEFoFhgxj1bwPI/m+zwL1j+h0dggA4CCkCHlPue0fKvl73lXy8zExcVUACKBmfsWwUs/1uJhvuA5T9cJAaaWUABmDndvmez/Otlb/nXy8zExQUUgOIBGv8eAcu/3qWw/OtlZuIJBBSACUJ0hKcFLP96l8Hyr5eZiScRUAAmCdIx/JW+Be+A5V8wNCPPI6AAzJNl55P4N/966Vv+9TIz8WQCCsBkgTY8juVfL3TLv15mJp5QQAGYMNRGR7L864Vt+dfLzMSTCigAkwbb4FgzL/+vTPLVE2Zo+U8YqiPVFVAA6mbXeXLLv176ln+9zEw8uYACMHnAEx7P8q8XquVfLzMTNxBQABqEPNERLf96YVr+9TIzcRMBBaBJ0BMc0/KvF6LlXy8zEzcSUAAahV34qJZ/vfAs/3qZmbiZgALQLPCCx7X864Vm+dfLzMQNBRSAhqEXOrLlXyisO6Na/vUyM3FTAQWgafAFjm35FwjprhEt/3qZmbixgALQOPyBj275DxzOA0az/OtlZuLmAgpA8wsw4PEt/wFDuWUky79eZiYmEAXAJRhJwPIfKY3TZrH8T3PyKQLDCSgAw0XSdiDLv170ln+9zExM4GkBBcBlGEHA8h8hhfNmsPzP8/JpAsMJKADDRdJuIMu/XuSWf73MTEzgHgEFwKU4UsDyP1L/sndb/pe5+RaB4QQUgOEiaTOQ5V8vasu/XmYmJvBAAQXA5ThCwPI/Qv26d1r+1/n5NoHhBBSA4SKZfiDLv17Eln+9zExM4FYBBeBWIh9YUcDyXxFzp0dZ/jtBew2BvQUUgL3F+77P8q+XveVfLzMTEzhZQAE4mcoHrxCw/K/AO+irlv9B8F5LYC8BBWAv6b7vsfzrZW/518vMxATOFlAAzibzhTMELP8zsAb5qOU/SBDGILC1gAKwtXDf51v+9bK3/OtlZmICFwsoABfT+eJDBCz/etfD8q+XmYkJXCWgAFzF58v3EbD8610Ly79eZiYmcLWAAnA1oQc8S8Dyr3cdLP96mZmYwCoCCsAqjB6SZObl/8IkXzNhypb/hKE6EoFTBRSAU6V87mECln+9+2H518vMxARWFVAAVuVs+TDLv17sln+9zExMYHUBBWB10lYPtPzrxW3518vMxAQ2EVAANmFt8VDLv17Mln+9zExMYDMBBWAz2qkfbPnXi9fyr5eZiQlsKqAAbMo75cMt/3qxWv71MjMxgc0FFIDNiad6geVfL07Lv15mJiawi4ACsAvzFC+x/OvFaPnXy8zEBHYTUAB2oy79Isu/XnyWf73MTExgVwEFYFfuki+z/OvFZvnXy8zEBHYXUAB2Jy/1Qsu/VFxPDWv518vMxAQOEVAADmEv8VLLv0RMrzGk5V8vMxMTOExAATiMfugXW/5Dx3Pf4Sz/epmZmMChAgrAofxDvtzyHzKWhw5l+dfLzMQEDhdQAA6PYKgBLP+h4jhpGMv/JCYfIkDgbgEFwJ24EbD8690Fy79eZiYmMIyAAjBMFIcOYvkfyn/Ryy3/i9h8iQCBGwEFwF2w/OvdAcu/XmYmJjCcgAIwXCS7DmT578q9ysss/1UYPYQAAQWg7x2w/Otlb/nXy8zEBIYVUACGjWbTwT4ryfckmTH/Fyb5mk31jnm45X+Mu7cSmFZgxgUwbVgrHezjkvyE5b+S5n6P+c4kn7Pf63Z706uSPD/JS3d7oxcRIPCUgALQ6yK8ZZKXJXmjCY8967/5L1F9QpIfnzAzy3/CUB2pjoACUCerNSb97iSfvcaDBnvGzMt/+dH/XyR57mDm145j+V8r6PsErhRQAK4ELPT1N0zyz0keKTTzKaPOvPyX839kkp8/BaLQZyz/QmEZdV4BBWDebO8+2Ycm+eXJjjv78l/i+uYkXzBRbpb/RGE6Sm0BBaB2fudM/4Ik33HOFwb/bIflv0TwkiQfPXgWp45n+Z8q5XMEdhBQAHZAHuQVn5fkWweZ5doxll/KeNck/3Ttgwp8/xeTfHiBOU8Z8ReSfFSSJ0/5sM8QILCtgAKwre9IT//UJI+PNNCVsyz/NcOjDUrADyX5lCutRvr6cgcfUwJGisQsXQUUgD7Jv1OSP53suB1KwPLr/8vvA5jpHyVgpjSdpayAAlA2urMHX7JeCsA7nv3Nsb8wewlY/vO/v5rwz+xQAsb+35XpGggoAA1CftYRZ/tlgJujzV4CZvtlgJvclIBe///jtIMJKACDBbLxOEvey28q+7CN33PE42cuAc9J8kdJ3uwI2I3fqQRsDOzxBB4koAD0uxtvkuQ3kyy/J2C2f2YuAe+b5FeSvMFsod35zal+Y+CEwTrS2AIKwNj5bDXd8m+Uvzbh7wdYvGYuAR90508FnO1Pc1xy85OArf7X7rkEHiCgAPS9GkpAzeyVgJq5mZrAcAIKwHCR7DqQErAr92ovUwJWo/QgAn0FFIC+2d+cXAmoeQeUgJq5mZrAMAIKwDBRHDqIEnAo/8UvVwIupvNFAgQUAHfATwJq3wEloHZ+pidwmIACcBj9kC/2k4AhY7l1KCXgViIfIEDgbgEFwJ24W0AJqHknlICauZmawGECCsBh9EO/WAkYOp4HDqcE1MzN1AQOEVAADmEv8VIloERM9wypBNTMzdQEdhdQAHYnL/VCJaBUXE8PqwTUzM3UBHYVUAB25S75MiWgZGxRAmrmZmoCuwkoALtRl36RElAzPiWgZm6mJrCLgAKwC/MUL1ECasaoBNTMzdQENhdQADYnnuoFSkDNOJWAmrmZmsCmAgrAprxTPlwJqBmrElAzN1MT2ExAAdiMduoHKwE141UCauZmagKbCCgAm7C2eKgSUDNmJaBmbqYmsLqAArA6aasHKgE141YCauZmagKrCigAq3K2fJgSUDN2JaBmbqYmsJqAArAaZesHKQE141cCauZmagKrCCgAqzB6SJLZS8DzkjwxYdJKwIShOhKBUwQUgFOUfOZUASXgVKmxPqcEjJWHaQjsIqAA7MLc6iVKQM24lYCauZmawMUCCsDFdL74EAEloOb1UAJq5mZqAhcJKAAXsfnSCQJKwAlIA35ECRgwFCMR2EJAAdhC1TNvBJSAmndBCaiZm6kJnCWgAJzF5cMXCCgBF6AN8BUlYIAQjEBgSwEFYEtdz/aTgNp3QAmonZ/pCTxUQAFwQfYS8JOAvaTXfY8SsK6npxEYRkABGCaKFoMoATVjVgJq5mZqAn4C4A4MJaAEDBXHycMoASdT+SCBGgJ+AlAjp9mmVAJqJqoE1MzN1ATuK6AAuBhHCSwl4NeTvMNRA2z43pcl8XcHbAi80aMfT/JYkic3er7HEhhKQAEYKo52wygBNSN/NMnPJXmk5vgPnVoJmDBUR7q/gALgZhwtoAQcncBl71cCLnPzLQLDCCgAw0TRehAloGb8SkDN3ExN4CkBBcBFGEVACRglifPmUALO8/JpAsMIKADDRGGQJEpAzWugBNTMzdTNBRSA5hdgwOMrAQOGcsJISsAJSD5CYCQBBWCkNMxyI6AE1LwLSkDN3EzdVEABaBp8gWMrAQVCus+ISkDN3EzdUEABaBh6oSMrAYXCetaoSkDN3EzdTEABaBZ4weMqAQVDS6IE1MzN1I0EFIBGYRc+qhJQMzwloGZupm4ioAA0CXqCYyoBNUNUAmrmZuoGAgpAg5AnOqISUDNMJaBmbqaeXEABmDzgCY+nBNQMVQmomZupJxZQACYOd+KjKQE1w1UCauZm6kkFFIBJg21wrJlLwMvv/C76JybMUQmYMFRHqimgANTMzdT/L6AE1LwJSkDN3Ew9mYACMFmgDY+jBNQMXQmomZupJxJQACYKs/FRlICa4SsBNXMz9SQCCsAkQTqGXw4oegeUgKLBGbu+gAJQP0MneEbATwJq3gYloGZupi4uoAAUD9D49wgoATUvhRJQMzdTFxZQAAqHZ/QHCigBNS+HElAzN1MXFVAAigZn7FsFlIBbiYb8gBIwZCyGmlFAAZgxVWe6EVACat4FJaBmbqYuJqAAFAvMuGcLKAFnkw3xBSVgiBgMMbOAAjBzus7mJwG174ASUDs/0w8uoAAMHpDxVhPwk4DVKHd9kBKwK7eXdRJQADql7axKQM07oATUzM3UgwsoAIMHZLzVBZSA1Ul3eaASsAuzl3QSUAA6pe2sfk9A7TugBNTOz/SDCSgAgwVinN0E/CRgN+pVX6QErMrpYZ0FFIDO6Tu7ElDzDigBNXMz9WACCsBggRhnd4G3SPJrSd5h9zdv/8KXJ1mW5RPbv2r3Nzwvyc8meWT3N2//wseTPJbkye1f5Q2dBRSAzuk7+42AElDzLigBNXMz9SACCsAgQRjjcAEl4PAILhpACbiIzZcIJAqAW0DgGQEloOZtUAJq5mbqgwUUgIMD8PrhBJSA4SI5aSAl4CQmHyLwjIAC4DYQuFdACah5K5SAmrmZ+iABBeAgeK8dXkAJGD6i+w6oBNTMzdQHCCgAB6B7ZRkBJaBMVK8xqBJQMzdT7yygAOwM7nXlBJSAcpE9NbASUDM3U+8ooADsiO1VZQWUgJrRKQE1czP1TgIKwE7QXlNeYPYSsCzLV5RP6d4DKAEThupI6wgoAOs4ekoPASWgZs5KQM3cTL2xgAKwMbDHTyegBNSMVAmomZupNxRQADbE9ehpBZSAmtEqATVzM/VGAgrARrAeO72AElAzYiWgZm6m3kBAAdgA1SPbCCgBNaNWAmrmZuqVBRSAlUE9rp2AElAzciWgZm6mXlFAAVgR06PaCigBNaNXAmrmZuqVBBSAlSA9pr2AElDzCigBNXMz9QoCCsAKiB5B4I6AElDzKigBNXMz9ZUCCsCVgL5O4C4BJaDmlVACauZm6isEFIAr8HyVwAMElICaV0MJqJmbqS8UUAAuhPM1ArcIKAE1r4gSUDM3U18goABcgOYrBE4UUAJOhBrsY0rAYIEYZxsBBWAbV08lcCOgBNS8C0pAzdxMfYaAAnAGlo8SuFBACbgQ7uCvKQEHB+D12wooANv6ejoBPwmofQeUgNr5mf4hAgqA60FgPwE/CdjPes03KQFranrWMAIKwDBRGKSJgBJQM2gloGZupvYTAHeAwFACSsBQcZw8jBJwMpUPVhDwE4AKKZlxRgEloGaqSkDN3Ex9HwEFwLUgcJyAEnCc/TVvVgKu0fPdYQQUgGGiMEhTgaUE/HqSt5/w/C9PsizLV0x4NiVgwlC7HUkB6Ja4844ooASMmMrtM31wkp9J8sjtHy33iceTPJbkyXKTG/hkAQXgZCofJLCpgBKwKe9mD1cCNqP14K0FFICthT2fwOkCSsDpViN9UgkYKQ2znCygAJxM5YMEdhFQAnZhXv0lSsDqpB64tYACsLWw5xM4X0AJON9shG8oASOkYIaTBRSAk6l8kMCuAjOXgD9P8kFJnthVdJ+XzV4CPiPJ/+xD6S1bCygAWwt7PoHLBWYuAX+Y5P2SvPpynmG/OXMJ+KYkXzKsvMHOElAAzuLyYQK7C8xcAr4xyZfuLrrPC2cuAY8meek+jN6ypYACsKWuZxNYR2DWEvBfSd560l8KWJKftQT8XpL3Wedqe8qRAgrAkfreTeB0gVlLwBck+dbTGcp9ctYS8E5JXlYuDQO/hoAC4EIQqCMwYwl4SZKPrRPBRZPOWAJekOS7LtLwpWEEFIBhojAIgZMEZisBf5Tk3U86ee0PzVYC/GbA2vfxqekVgAlCdIR2AjOVgD9L8s5NEpypBHxLki9sktu0x1QApo3WwSYXmKUE/GqSD5k8q2cfb5YS8MVJXtwotymPqgBMGatDNRGYoQR8XZIvb5LXzTFnKAHvn+S3muU23XEVgOkidaBmAtVLwLsl+eNmmS3HrVwC/i7Jc/1VwfVvrQJQP0MnIFC1BPxUko9vHF/VEvDZSb6ncW7THF0BmCZKB2kuUK0E/EuS90jyD81zq1YCfiXJR/j7AOa4tQrAHDk6BYFFoEoJeFWSD03y22J7SqBKCfiTJB+Q5F/lNoeAAjBHjk5B4EZg9BKwLP/n+7Pk77mwo5eAZfkvM77S/9TmEVAA5snSSQiMXltjKt0AAAZCSURBVAIs/4ff0VFLgOU/6f+3KACTButY7QVG+0mA5X/alRytBFj+p+VW8lMKQMnYDE3gJIFRSoDlf1JcT39olBLwp0me58f+54VX6dMKQKW0zErgfIGjS4Dlf35myzeOLgGW/2W5lfqWAlAqLsMSuEjgqBJg+V8U1+E/CbD8r8utzLcVgDJRGZTAVQJ7lwDL/6q4DisBlv86uZV4igJQIiZDElhFYK8SYPmvEtfuJWD5mxkf9Wv+64Y38tMUgJHTMRuB9QW2LgGW//qZ7fF7Aiz/bXIb+qkKwNDxGI7AJgJblQDLf5O4Nv9JgOW/bW7DPl0BGDYagxHYVGDtEmD5bxrXZiXA8t8ntyHfogAMGYuhCOwisFYJsPx3iWv1ErAs/+W/8/+nfcf3tlEEFIBRkjAHgWMEri0Blv8xuV375wRY/sfkNtRbFYCh4jAMgUMELi0Blv8hcV39kwDL/9jchnm7AjBMFAYhcKjAc5L8bJL3PHGKf0nyMf5K3xO1tvvY8tfz/nSSNz7xFb+X5KP9p34nak3+MQVg8oAdj8AZAq+f5EVJPj/J6z3kez+V5HOT/MMZz/bR7QTeKsm3J/moh7zi1UlenORrk/zndqN4ciUBBaBSWmYlsI/A8tOAT0rygUmem+R1k7wiye8m+bEkf7zPGN5ypsB7JPnEJO+dZMnwv5P8dZKXJvlR/9Z/pmaDjysADUJ2RAIECBAgcLeAAuBOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECCgA7gABAgQIEGgooAA0DN2RCRAgQICAAuAOECBAgACBhgIKQMPQHZkAAQIECPwfXTEqW2JkfqUAAAAASUVORK5CYII=");
  background-repeat: no-repeat;
  padding-left: 18px !important;
  background-size: 100%;
  background-position-y: 100%;
}
.fc-icon-right-single-arrow {
  background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAYAAAD0eNT6AAAgAElEQVR4Xu3dW8i2aVkG4NO0UtspFVMKKbTMglLciCA0xxZoqBChaBSpbZWSJRQioRtiBoaF1kaUZm6USSS4oLWlFEW2dFEkWBGmToFBJAou4p2Zf/xn5p//exfP4r7u6xhoq/d9nus+znu4zvn85p/7xF8ECBAgQIBAO4H7tDuxAxMgQIAAAQJRAFwCAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQIECDQUEABaBi6IxMgQIAAAQXAHSBAgAABAg0FFICGoTsyAQIECBBQANwBAgQI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gIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQIKADuAAECBAgQaCigADQM3ZEJECBAgIAC4A4QIECAAIGGAgpAw9AdmQABAgQI/D/JuK1bmtWxoQAAAABJRU5ErkJggg==");
  background-repeat: no-repeat;
  padding-left: 18px !important;
  background-size: 100%;
  background-position-y: 100%;
}
</style>
<script src="<?= base_url(); ?>assets/plugins/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

<script src="<?= base_url(); ?>assets/plugins/general/moment/min/moment.min.js" type="text/javascript"></script>
<script src='<?= base_url(); ?>assets/js/fullcalendar.min.js'></script>

<script>

    $(document).ready(function() {
        
        $('#kalender').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '<?= date('Y-m-d'); ?>',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                
                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #direktorat').val(event.direktorat);
                    $('#ModalEdit #subdirektorat').val(event.subdirektorat);
                    $('#ModalEdit #tanggal').val(event.tanggal);
                    $('#ModalEdit #lokasi').val(event.lokasi);
                    $('#ModalEdit #peserta').val(event.peserta);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

                edit(event);

            },
            events: [
            <?php foreach($events as $event): 
            
                $start = explode(" ", $event['tanggal']);
                $end = explode(" ", $event['tanggal_selesai']);
                if($start[1] == '00:00:00'){
                    $start = $start[0];
                }else{
                    $start = $event['tanggal'];
                }
                if($end[1] == '00:00:00'){
                    $end = $end[0];
                }else{
                    $end = $event['tanggal_selesai'];
                }
            ?>
                {
                    id: '<?php echo $event['id_jadwal_kegiatan']; ?>',
                    title: '<?php echo $event['kegiatan']; ?>',
                    direktorat: '<?php echo $event['direktorat']; ?>',
                    subdirektorat: '<?php echo $event['subdirektorat']; ?>',
                    tanggal: '<?php echo date('Y-m-d\TH:i:s', strtotime($event['tanggal'])); ?>',
                    lokasi: '<?php echo $event['lokasi']; ?>',
                    peserta: '<?php echo $event['peserta']; ?>',
                    start: '<?php echo $start; ?>',
                    end: '<?php echo $end; ?>',
                    color: '<?php echo $event['color']; ?>',
                },
            <?php endforeach; ?>
            ]
        });
        
        // function edit(event){
        // 	start = event.start.format('YYYY-MM-DD HH:mm:ss');
        // 	if(event.end){
        // 		end = event.end.format('YYYY-MM-DD HH:mm:ss');
        // 	}else{
        // 		end = start;
        // 	}
            
        // 	id =  event.id;
            
        // 	Event = [];
        // 	Event[0] = id;
        // 	Event[1] = start;
        // 	Event[2] = end;
            
        // 	$.ajax({
        // 	 url: '<?= base_url(); ?>guest/Master/simpan_data_timeline',
        // 	 type: "POST",
        // 	 data: {Event:Event},
        // 	 success: function(rep) {
        // 			if(rep == 'OK'){
        // 				alert('Saved');
        // 			}else{
        // 				alert('Could not be saved. try again.'); 
        // 			}
        // 		}
        // 	});
        // }
        
    });

</script>