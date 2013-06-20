!function ($) {

  "use strict"; // jshint ;_

 /* FILEUPLOAD PUBLIC CLASS DEFINITION
  * ================================= */

  var Fileupload = function (element, options) {
    this.$element = $(element)
    this.type = this.$element.data('uploadtype') || (this.$element.find('.thumbnail').length > 0 ? "image" : "file")
      
    this.$input = this.$element.find(':file')
    if (this.$input.length === 0) return

    this.name = this.$input.attr('name') || options.name

    this.$hidden = this.$element.find('input[type=hidden][name="'+this.name+'"]')
    if (this.$hidden.length === 0) {
      this.$hidden = $('<input type="hidden" />')
      this.$element.prepend(this.$hidden)
    }

    this.$preview = this.$element.find('.fileupload-preview')
    var height = this.$preview.css('height')
    if (this.$preview.css('display') != 'inline' && height != '0px' && height != 'none') this.$preview.css('line-height', height)

    this.original = {
      'exists': this.$element.hasClass('fileupload-exists'),
      'preview': this.$preview.html(),
      'hiddenVal': this.$hidden.val()
    }
    
    this.$remove = this.$element.find('[data-dismiss="fileupload"]')

    this.$element.find('[data-trigger="fileupload"]').on('click.fileupload', $.proxy(this.trigger, this))

    this.listen()
  }
  
  Fileupload.prototype = {
    
    listen: function() {
      this.$input.on('change.fileupload', $.proxy(this.change, this))
      $(this.$input[0].form).on('reset.fileupload', $.proxy(this.reset, this))
      if (this.$remove) this.$remove.on('click.fileupload', $.proxy(this.clear, this))
    },
    
    change: function(e, invoked) {
      if (invoked === 'clear') return
      
      var file = e.target.files !== undefined ? e.target.files[0] : (e.target.value ? { name: e.target.value.replace(/^.+\\/, '') } : null)
      
      if (!file) {
        this.clear()
        return
      }
      
      this.$hidden.val('')
      this.$hidden.attr('name', '')
      this.$input.attr('name', this.name)

      if (this.type === "image" && this.$preview.length > 0 && (typeof file.type !== "undefined" ? file.type.match('image.*') : file.name.match(/\.(gif|png|jpe?g)$/i)) && typeof FileReader !== "undefined") {
        var reader = new FileReader()
        var preview = this.$preview
        var element = this.$element

        reader.onload = function(e) {
          preview.html('<img src="' + e.target.result + '" ' + (preview.css('max-height') != 'none' ? 'style="max-height: ' + preview.css('max-height') + ';"' : '') + ' />')
          element.addClass('fileupload-exists').removeClass('fileupload-new')
        }

        reader.readAsDataURL(file)
      } else {
        this.$preview.text(file.name)
        this.$element.addClass('fileupload-exists').removeClass('fileupload-new')
      }
    },

    clear: function(e) {
      this.$hidden.val('')
      this.$hidden.attr('name', this.name)
      this.$input.attr('name', '')

      //ie8+ doesn't support changing the value of input with type=file so clone instead
      if (navigator.userAgent.match(/msie/i)){ 
          var inputClone = this.$input.clone(true);
          this.$input.after(inputClone);
          this.$input.remove();
          this.$input = inputClone;
      }else{
          this.$input.val('')
      }

      this.$preview.html('')
      this.$element.addClass('fileupload-new').removeClass('fileupload-exists')

      if (e) {
        this.$input.trigger('change', [ 'clear' ])
        e.preventDefault()
      }
    },
    
    reset: function(e) {
      this.clear()
      
      this.$hidden.val(this.original.hiddenVal)
      this.$preview.html(this.original.preview)
      
      if (this.original.exists) this.$element.addClass('fileupload-exists').removeClass('fileupload-new')
       else this.$element.addClass('fileupload-new').removeClass('fileupload-exists')
    },
    
    trigger: function(e) {
      this.$input.trigger('click')
      e.preventDefault()
    }
  }

  
 /* FILEUPLOAD PLUGIN DEFINITION
  * =========================== */

  $.fn.fileupload = function (options) {
    return this.each(function () {
      var $this = $(this)
      , data = $this.data('fileupload')
      if (!data) $this.data('fileupload', (data = new Fileupload(this, options)))
      if (typeof options == 'string') data[options]()
    })
  }

  $.fn.fileupload.Constructor = Fileupload


 /* FILEUPLOAD DATA-API
  * ================== */

  $(document).on('click.fileupload.data-api', '[data-provides="fileupload"]', function (e) {
    var $this = $(this)
    if ($this.data('fileupload')) return
    $this.fileupload($this.data())
      
    var $target = $(e.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');
    if ($target.length > 0) {
      $target.trigger('click.fileupload')
      e.preventDefault()
    }
  })

}(window.jQuery);

/*******************************
* dataTables bootstrap
*******************************/
/* Set the defaults for DataTables initialisation */
$.extend( true, $.fn.dataTable.defaults, {
  "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
  "sPaginationType": "bootstrap",
  "oLanguage": {
    "sLengthMenu": "_MENU_ tampil per hal"
  }
} );


/* Default class modification */
$.extend( $.fn.dataTableExt.oStdClasses, {
  "sWrapper": "dataTables_wrapper form-inline"
} );


/* API method to get paging information */
$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
{
  return {
    "iStart":         oSettings._iDisplayStart,
    "iEnd":           oSettings.fnDisplayEnd(),
    "iLength":        oSettings._iDisplayLength,
    "iTotal":         oSettings.fnRecordsTotal(),
    "iFilteredTotal": oSettings.fnRecordsDisplay(),
    "iPage":          oSettings._iDisplayLength === -1 ?
      0 : Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
    "iTotalPages":    oSettings._iDisplayLength === -1 ?
      0 : Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
  };
};


/* Bootstrap style pagination control */
$.extend( $.fn.dataTableExt.oPagination, {
  "bootstrap": {
    "fnInit": function( oSettings, nPaging, fnDraw ) {
      var oLang = oSettings.oLanguage.oPaginate;
      var fnClickHandler = function ( e ) {
        e.preventDefault();
        if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
          fnDraw( oSettings );
        }
      };

      $(nPaging).addClass('pagination').append(
        '<ul>'+
          '<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
          '<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
        '</ul>'
      );
      var els = $('a', nPaging);
      $(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
      $(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
    },

    "fnUpdate": function ( oSettings, fnDraw ) {
      var iListLength = 5;
      var oPaging = oSettings.oInstance.fnPagingInfo();
      var an = oSettings.aanFeatures.p;
      var i, ien, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);

      if ( oPaging.iTotalPages < iListLength) {
        iStart = 1;
        iEnd = oPaging.iTotalPages;
      }
      else if ( oPaging.iPage <= iHalf ) {
        iStart = 1;
        iEnd = iListLength;
      } else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
        iStart = oPaging.iTotalPages - iListLength + 1;
        iEnd = oPaging.iTotalPages;
      } else {
        iStart = oPaging.iPage - iHalf + 1;
        iEnd = iStart + iListLength - 1;
      }

      for ( i=0, ien=an.length ; i<ien ; i++ ) {
        // Remove the middle elements
        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

        // Add the new list items and their event handlers
        for ( j=iStart ; j<=iEnd ; j++ ) {
          sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
          $('<li '+sClass+'><a href="#">'+j+'</a></li>')
            .insertBefore( $('li:last', an[i])[0] )
            .bind('click', function (e) {
              e.preventDefault();
              oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
              fnDraw( oSettings );
            } );
        }

        // Add / remove disabled classes from the static elements
        if ( oPaging.iPage === 0 ) {
          $('li:first', an[i]).addClass('disabled');
        } else {
          $('li:first', an[i]).removeClass('disabled');
        }

        if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
          $('li:last', an[i]).addClass('disabled');
        } else {
          $('li:last', an[i]).removeClass('disabled');
        }
      }
    }
  }
} );


/*
 * TableTools Bootstrap compatibility
 * Required TableTools 2.1+
 */
if ( $.fn.DataTable.TableTools ) {
  // Set the classes that TableTools uses to something suitable for Bootstrap
  $.extend( true, $.fn.DataTable.TableTools.classes, {
    "container": "DTTT btn-group",
    "buttons": {
      "normal": "btn",
      "disabled": "disabled"
    },
    "collection": {
      "container": "DTTT_dropdown dropdown-menu",
      "buttons": {
        "normal": "",
        "disabled": "disabled"
      }
    },
    "print": {
      "info": "DTTT_print_info modal"
    },
    "select": {
      "row": "active"
    }
  } );

  // Have the collection use a bootstrap compatible dropdown
  $.extend( true, $.fn.DataTable.TableTools.DEFAULTS.oTags, {
    "collection": {
      "container": "ul",
      "button": "li",
      "liner": "a"
    }
  } );
}


/* Table initialisation */
$(document).ready(function() {
  $('#data').dataTable( {
    "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
    "sPaginationType": "bootstrap",
    "oLanguage": {
      "sLengthMenu": "_MENU_ tampil per hal"
    }
  } );
} );


 $(document).ready(function(){
        $("#form, #register, #ganti").validate();

        $('#textarea').redactor();

        $('label.tree-toggler').click(function () {
          $(this).parent().children('ul.tree').toggle(300);
        });

        $('label.has-sub, label.tree').click(function () {
          $(this).parent().children('ul.sub, ul.subtree').toggle(300);
        });

        $('div.komen, div.biodata, div.baca').click(function () {
          $(this).parent().children('div.tulis, table.bio, div.lihat').toggle(300);
        });

        $(".well ul li a").each(function(){
            if($(this).attr("href")==window.location.pathname)
                $(this).addClass("btn-primary");
        });

        var jsonKota = '[{"kid": 1,"pid": 1,"kota": "Kabupaten Aceh Barat"}, {"kid": 2,"pid": 1,"kota": "Kabupaten Aceh Barat Daya"}, {"kid": 3,"pid": 1,"kota": "Kabupaten Aceh Besar"}, {"kid": 4,"pid": 1,"kota": "Kabupaten Aceh Jaya"}, {"kid": 5,"pid": 1,"kota": "Kabupaten Aceh Selatan"}, {"kid": 6,"pid": 1,"kota": "Kabupaten Aceh Singkil"}, {"kid": 7,"pid": 1,"kota": "Kabupaten Aceh Tamiang"}, {"kid": 8,"pid": 1,"kota": "Kabupaten Aceh Tengah"}, {"kid": 9,"pid": 1,"kota": "Kabupaten Aceh Tenggara"}, {"kid": 10,"pid": 1,"kota": "Kabupaten Aceh Timur"}, {"kid": 11,"pid": 1,"kota": "Kabupaten Aceh Utara"}, {"kid": 12,"pid": 1,"kota": "Kabupaten Bener Meriah"}, {"kid": 13,"pid": 1,"kota": "Kabupaten Bireuen"}, {"kid": 14,"pid": 1,"kota": "Kabupaten Gayo Lues"}, {"kid": 15,"pid": 1,"kota": "Kabupaten Nagan Raya"}, {"kid": 16,"pid": 1,"kota": "Kabupaten Pidie"}, {"kid": 17,"pid": 1,"kota": "Kabupaten Pidie Jaya"}, {"kid": 18,"pid": 1,"kota": "Kabupaten Simeulue"}, {"kid": 19,"pid": 1,"kota": "Kota Banda Aceh"}, {"kid": 20,"pid": 1,"kota": "Kota Langsa"}, {"kid": 21,"pid": 1,"kota": "Kota Lhokseumawe"}, {"kid": 22,"pid": 1,"kota": "Kota Sabang"}, {"kid": 23,"pid": 1,"kota": "Kota Subulussalam"}, {"kid": 24,"pid": 2,"kota": "Kabupaten Asahan"}, {"kid": 25,"pid": 2,"kota": "Kabupaten Batu Bara"}, {"kid": 26,"pid": 2,"kota": "Kabupaten Dairi"}, {"kid": 27,"pid": 2,"kota": "Kabupaten Deli Serdang"}, {"kid": 28,"pid": 2,"kota": "Kabupaten Humbang Hasundutan"}, {"kid": 29,"pid": 2,"kota": "Kabupaten Karo"}, {"kid": 30,"pid": 2,"kota": "Kabupaten Labuhanbatu"}, {"kid": 31,"pid": 2,"kota": "Kabupaten Labuhanbatu Selatan"}, {"kid": 32,"pid": 2,"kota": "Kabupaten Labuhanbatu Utara"}, {"kid": 33,"pid": 2,"kota": "Kabupaten Langkat"}, {"kid": 34,"pid": 2,"kota": "Kabupaten Mandailing Natal"}, {"kid": 35,"pid": 2,"kota": "Kabupaten Nias"}, {"kid": 36,"pid": 2,"kota": "Kabupaten Nias Barat"}, {"kid": 37,"pid": 2,"kota": "Kabupaten Nias Selatan"}, {"kid": 38,"pid": 2,"kota": "Kabupaten Nias Utara"}, {"kid": 39,"pid": 2,"kota": "Kabupaten Padang Lawas"}, {"kid": 40,"pid": 2,"kota": "Kabupaten Padang Lawas Utara"}, {"kid": 41,"pid": 2,"kota": "Kabupaten Pakpak Bharat"}, {"kid": 42,"pid": 2,"kota": "Kabupaten Samosir"}, {"kid": 43,"pid": 2,"kota": "Kabupaten Serdang Bedagai"}, {"kid": 44,"pid": 2,"kota": "Kabupaten Simalungun"}, {"kid": 45,"pid": 2,"kota": "Kabupaten Tapanuli Selatan"}, {"kid": 46,"pid": 2,"kota": "Kabupaten Tapanuli Tengah"}, {"kid": 47,"pid": 2,"kota": "Kabupaten Tapanuli Utara"}, {"kid": 48,"pid": 2,"kota": "Kabupaten Toba Samosir"}, {"kid": 49,"pid": 2,"kota": "Kota Binjai"}, {"kid": 50,"pid": 2,"kota": "Kota Gunung Sitoli"}, {"kid": 51,"pid": 2,"kota": "Kota Medan"}, {"kid": 52,"pid": 2,"kota": "Kota Padang Sidempuan"}, {"kid": 53,"pid": 2,"kota": "Kota Pematangsiantar"}, {"kid": 54,"pid": 2,"kota": "Kota Sibolga"}, {"kid": 55,"pid": 2,"kota": "Kota Tanjung Balai"}, {"kid": 56,"pid": 2,"kota": "Kota Tebing Tinggi"}, {"kid": 57,"pid": 3,"kota": "Kabupaten Bengkulu Selatan"}, {"kid": 58,"pid": 3,"kota": "Kabupaten Bengkulu Tengah"}, {"kid": 59,"pid": 3,"kota": "Kabupaten Bengkulu Utara"}, {"kid": 60,"pid": 3,"kota": "Kabupaten Benteng"}, {"kid": 61,"pid": 3,"kota": "Kabupaten Kaur"}, {"kid": 62,"pid": 3,"kota": "Kabupaten Kepahiang"}, {"kid": 63,"pid": 3,"kota": "Kabupaten Lebong"}, {"kid": 64,"pid": 3,"kota": "Kabupaten Mukomuko"}, {"kid": 65,"pid": 3,"kota": "Kabupaten Rejang Lebong"}, {"kid": 66,"pid": 3,"kota": "Kabupaten Seluma"}, {"kid": 67,"pid": 3,"kota": "Kota Bengkulu"}, {"kid": 68,"pid": 4,"kota": "Kabupaten Batang Hari"}, {"kid": 69,"pid": 4,"kota": "Kabupaten Bungo"}, {"kid": 70,"pid": 4,"kota": "Kabupaten Kerinci"}, {"kid": 71,"pid": 4,"kota": "Kabupaten Merangin"}, {"kid": 72,"pid": 4,"kota": "Kabupaten Muaro Jambi"}, {"kid": 73,"pid": 4,"kota": "Kabupaten Sarolangun"}, {"kid": 74,"pid": 4,"kota": "Kabupaten Tanjung Jabung Barat"}, {"kid": 75,"pid": 4,"kota": "Kabupaten Tanjung Jabung Timur"}, {"kid": 76,"pid": 4,"kota": "Kabupaten Tebo"}, {"kid": 77,"pid": 4,"kota": "Kota Jambi"}, {"kid": 78,"pid": 4,"kota": "Kota Sungai Penuh"}, {"kid": 79,"pid": 5,"kota": "Kabupaten Bengkalis"}, {"kid": 80,"pid": 5,"kota": "Kabupaten Indragiri Hilir"}, {"kid": 81,"pid": 5,"kota": "Kabupaten Indragiri Hulu"}, {"kid": 82,"pid": 5,"kota": "Kabupaten Kampar"}, {"kid": 83,"pid": 5,"kota": "Kabupaten Kuantan Singingi"}, {"kid": 84,"pid": 5,"kota": "Kabupaten Pelalawan"}, {"kid": 85,"pid": 5,"kota": "Kabupaten Rokan Hilir"}, {"kid": 86,"pid": 5,"kota": "Kabupaten Rokan Hulu"}, {"kid": 87,"pid": 5,"kota": "Kabupaten Siak"}, {"kid": 88,"pid": 5,"kota": "Kota Pekanbaru"}, {"kid": 89,"pid": 5,"kota": "Kota Dumai"}, {"kid": 90,"pid": 5,"kota": "Kabupaten Kepulauan Meranti"}, {"kid": 91,"pid": 6,"kota": "Kabupaten Agam"}, {"kid": 92,"pid": 6,"kota": "Kabupaten Dharmasraya"}, {"kid": 93,"pid": 6,"kota": "Kabupaten Kepulauan Mentawai"}, {"kid": 94,"pid": 6,"kota": "Kabupaten Lima Puluh Kota"}, {"kid": 95,"pid": 6,"kota": "Kabupaten Padang Pariaman"}, {"kid": 96,"pid": 6,"kota": "Kabupaten Pasaman"}, {"kid": 97,"pid": 6,"kota": "Kabupaten Pasaman Barat"}, {"kid": 98,"pid": 6,"kota": "Kabupaten Pesisir Selatan"}, {"kid": 99,"pid": 6,"kota": "Kabupaten Sijunjung"}, {"kid": 100,"pid": 6,"kota": "Kabupaten Solok"}, {"kid": 101,"pid": 6,"kota": "Kabupaten Solok Selatan"}, {"kid": 102,"pid": 6,"kota": "Kabupaten Tanah Datar"}, {"kid": 103,"pid": 6,"kota": "Kota Bukittinggi"}, {"kid": 104,"pid": 6,"kota": "Kota Padang"}, {"kid": 105,"pid": 6,"kota": "Kota Padangpanjang"}, {"kid": 106,"pid": 6,"kota": "Kota Pariaman"}, {"kid": 107,"pid": 6,"kota": "Kota Payakumbuh"}, {"kid": 108,"pid": 6,"kota": "Kota Sawahlunto"}, {"kid": 109,"pid": 6,"kota": "Kota Solok"}, {"kid": 110,"pid": 7,"kota": "Kabupaten Banyuasin"}, {"kid": 111,"pid": 7,"kota": "Kabupaten Empat Lawang"}, {"kid": 112,"pid": 7,"kota": "Kabupaten Lahat"}, {"kid": 113,"pid": 7,"kota": "Kabupaten Muara Enim"}, {"kid": 114,"pid": 7,"kota": "Kabupaten Musi Banyuasin"}, {"kid": 115,"pid": 7,"kota": "Kabupaten Musi Rawas"}, {"kid": 116,"pid": 7,"kota": "Kabupaten Ogan Ilir"}, {"kid": 117,"pid": 7,"kota": "Kabupaten Ogan Komering Ilir"}, {"kid": 118,"pid": 7,"kota": "Kabupaten Ogan Komering Ulu"}, {"kid": 119,"pid": 7,"kota": "Kabupaten Ogan Komering Ulu Selatan"}, {"kid": 120,"pid": 7,"kota": "Kabupaten Ogan Komering Ulu Timur"}, {"kid": 121,"pid": 7,"kota": "Kota Lubuklinggau"}, {"kid": 122,"pid": 7,"kota": "Kota Pagar Alam"}, {"kid": 123,"pid": 7,"kota": "Kota Palembang"}, {"kid": 124,"pid": 7,"kota": "Kota Prabumulih"}, {"kid": 125,"pid": 8,"kota": "Kabupaten Lampung Barat"}, {"kid": 126,"pid": 8,"kota": "Kabupaten Lampung Selatan"}, {"kid": 127,"pid": 8,"kota": "Kabupaten Lampung Tengah"}, {"kid": 128,"pid": 8,"kota": "Kabupaten Lampung Timur"}, {"kid": 129,"pid": 8,"kota": "Kabupaten Lampung Utara"}, {"kid": 130,"pid": 8,"kota": "Kabupaten Mesuji"}, {"kid": 131,"pid": 8,"kota": "Kabupaten Pesawaran"}, {"kid": 132,"pid": 8,"kota": "Kabupaten Pringsewu"}, {"kid": 133,"pid": 8,"kota": "Kabupaten Tanggamus"}, {"kid": 134,"pid": 8,"kota": "Kabupaten Tulang Bawang"}, {"kid": 135,"pid": 8,"kota": "Kabupaten Tulang Bawang Barat"}, {"kid": 136,"pid": 8,"kota": "Kabupaten Way Kanan"}, {"kid": 137,"pid": 8,"kota": "Kota Bandar Lampung"}, {"kid": 138,"pid": 8,"kota": "Kota Metro"}, {"kid": 139,"pid": 9,"kota": "Kabupaten Bangka"}, {"kid": 140,"pid": 9,"kota": "Kabupaten Bangka Barat"}, {"kid": 141,"pid": 9,"kota": "Kabupaten Bangka Selatan"}, {"kid": 142,"pid": 9,"kota": "Kabupaten Bangka Tengah"}, {"kid": 143,"pid": 9,"kota": "Kabupaten Belitung"}, {"kid": 144,"pid": 9,"kota": "Kabupaten Belitung Timur"}, {"kid": 145,"pid": 9,"kota": "Kota Pangkal Pinang"}, {"kid": 146,"pid": 10,"kota": "Kabupaten Bintan"}, {"kid": 147,"pid": 10,"kota": "Kabupaten Karimun"}, {"kid": 148,"pid": 10,"kota": "Kabupaten Kepulauan Anambas"}, {"kid": 149,"pid": 10,"kota": "Kabupaten Lingga"}, {"kid": 150,"pid": 10,"kota": "Kabupaten Natuna"}, {"kid": 151,"pid": 10,"kota": "Kota Batam"}, {"kid": 152,"pid": 10,"kota": "Kota Tanjung Pinang"}, {"kid": 153,"pid": 11,"kota": "Kabupaten Lebak"}, {"kid": 154,"pid": 11,"kota": "Kabupaten Pandeglang"}, {"kid": 155,"pid": 11,"kota": "Kabupaten Serang"}, {"kid": 156,"pid": 11,"kota": "Kabupaten Tangerang"}, {"kid": 157,"pid": 11,"kota": "Kota Cilegon"}, {"kid": 158,"pid": 11,"kota": "Kota Serang"}, {"kid": 159,"pid": 11,"kota": "Kota Tangerang"}, {"kid": 160,"pid": 11,"kota": "Kota Tangerang Selatan"}, {"kid": 161,"pid": 12,"kota": "Kabupaten Bandung"}, {"kid": 162,"pid": 12,"kota": "Kabupaten Bandung Barat"}, {"kid": 163,"pid": 12,"kota": "Kabupaten Bekasi"}, {"kid": 164,"pid": 12,"kota": "Kabupaten Bogor"}, {"kid": 165,"pid": 12,"kota": "Kabupaten Ciamis"}, {"kid": 166,"pid": 12,"kota": "Kabupaten Cianjur"}, {"kid": 167,"pid": 12,"kota": "Kabupaten Cirebon"}, {"kid": 168,"pid": 12,"kota": "Kabupaten Garut"}, {"kid": 169,"pid": 12,"kota": "Kabupaten Indramayu"}, {"kid": 170,"pid": 12,"kota": "Kabupaten Karawang"}, {"kid": 171,"pid": 12,"kota": "Kabupaten Kuningan"}, {"kid": 172,"pid": 12,"kota": "Kabupaten Majalengka"}, {"kid": 173,"pid": 12,"kota": "Kabupaten Purwakarta"}, {"kid": 174,"pid": 12,"kota": "Kabupaten Subang"}, {"kid": 175,"pid": 12,"kota": "Kabupaten Sukabumi"}, {"kid": 176,"pid": 12,"kota": "Kabupaten Sumedang"}, {"kid": 177,"pid": 12,"kota": "Kabupaten Tasikmalaya"}, {"kid": 178,"pid": 12,"kota": "Kota Bandung"}, {"kid": 179,"pid": 12,"kota": "Kota Banjar"}, {"kid": 180,"pid": 12,"kota": "Kota Bekasi"}, {"kid": 181,"pid": 12,"kota": "Kota Bogor"}, {"kid": 182,"pid": 12,"kota": "Kota Cimahi"}, {"kid": 183,"pid": 12,"kota": "Kota Cirebon"}, {"kid": 184,"pid": 12,"kota": "Kota Depok"}, {"kid": 185,"pid": 12,"kota": "Kota Sukabumi"}, {"kid": 186,"pid": 12,"kota": "Kota Tasikmalaya"}, {"kid": 187,"pid": 13,"kota": "Kabupaten Administrasi Kepulauan Seribu"}, {"kid": 188,"pid": 13,"kota": "Kota Administrasi Jakarta Barat"}, {"kid": 189,"pid": 13,"kota": "Kota Administrasi Jakarta Pusat"}, {"kid": 190,"pid": 13,"kota": "Kota Administrasi Jakarta Selatan"}, {"kid": 191,"pid": 13,"kota": "Kota Administrasi Jakarta Timur"}, {"kid": 192,"pid": 13,"kota": "Kota Administrasi Jakarta Utara"}, {"kid": 193,"pid": 14,"kota": "Kabupaten Banjarnegara"}, {"kid": 194,"pid": 14,"kota": "Kabupaten Banyumas"}, {"kid": 195,"pid": 14,"kota": "Kabupaten Batang"}, {"kid": 196,"pid": 14,"kota": "Kabupaten Blora"}, {"kid": 197,"pid": 14,"kota": "Kabupaten Boyolali"}, {"kid": 198,"pid": 14,"kota": "Kabupaten Brebes"}, {"kid": 199,"pid": 14,"kota": "Kabupaten Cilacap"}, {"kid": 200,"pid": 14,"kota": "Kabupaten Demak"}, {"kid": 201,"pid": 14,"kota": "Kabupaten Grobogan"}, {"kid": 202,"pid": 14,"kota": "Kabupaten Jepara"}, {"kid": 203,"pid": 14,"kota": "Kabupaten Karanganyar"}, {"kid": 204,"pid": 14,"kota": "Kabupaten Kebumen"}, {"kid": 205,"pid": 14,"kota": "Kabupaten Kendal"}, {"kid": 206,"pid": 14,"kota": "Kabupaten Klaten"}, {"kid": 207,"pid": 14,"kota": "Kabupaten Kudus"}, {"kid": 208,"pid": 14,"kota": "Kabupaten Magelang"}, {"kid": 209,"pid": 14,"kota": "Kabupaten Pati"}, {"kid": 210,"pid": 14,"kota": "Kabupaten Pekalongan"}, {"kid": 211,"pid": 14,"kota": "Kabupaten Pemalang"}, {"kid": 212,"pid": 14,"kota": "Kabupaten Purbalingga"}, {"kid": 213,"pid": 14,"kota": "Kabupaten Purworejo"}, {"kid": 214,"pid": 14,"kota": "Kabupaten Rembang"}, {"kid": 215,"pid": 14,"kota": "Kabupaten Semarang"}, {"kid": 216,"pid": 14,"kota": "Kabupaten Sragen"}, {"kid": 217,"pid": 14,"kota": "Kabupaten Sukoharjo"}, {"kid": 218,"pid": 14,"kota": "Kabupaten Tegal"}, {"kid": 219,"pid": 14,"kota": "Kabupaten Temanggung"}, {"kid": 220,"pid": 14,"kota": "Kabupaten Wonogiri"}, {"kid": 221,"pid": 14,"kota": "Kabupaten Wonosobo"}, {"kid": 222,"pid": 14,"kota": "Kota Magelang"}, {"kid": 223,"pid": 14,"kota": "Kota Pekalongan"}, {"kid": 224,"pid": 14,"kota": "Kota Salatiga"}, {"kid": 225,"pid": 14,"kota": "Kota Semarang"}, {"kid": 226,"pid": 14,"kota": "Kota Surakarta"}, {"kid": 227,"pid": 14,"kota": "Kota Tegal"}, {"kid": 228,"pid": 14,"kota": "Purwokerto"}, {"kid": 229,"pid": 15,"kota": "Kabupaten Bangkalan"}, {"kid": 230,"pid": 15,"kota": "Kabupaten Banyuwangi"}, {"kid": 231,"pid": 15,"kota": "Kabupaten Blitar"}, {"kid": 232,"pid": 15,"kota": "Kabupaten Bojonegoro"}, {"kid": 233,"pid": 15,"kota": "Kabupaten Bondowoso"}, {"kid": 234,"pid": 15,"kota": "Kabupaten Gresik"}, {"kid": 235,"pid": 15,"kota": "Kabupaten Jember"}, {"kid": 236,"pid": 15,"kota": "Kabupaten Jombang"}, {"kid": 237,"pid": 15,"kota": "Kabupaten Kediri"}, {"kid": 238,"pid": 15,"kota": "Kabupaten Lamongan"}, {"kid": 239,"pid": 15,"kota": "Kabupaten Lumajang"}, {"kid": 240,"pid": 15,"kota": "Kabupaten Madiun"}, {"kid": 241,"pid": 15,"kota": "Kabupaten Magetan"}, {"kid": 242,"pid": 15,"kota": "Kabupaten Malang"}, {"kid": 243,"pid": 15,"kota": "Kabupaten Mojokerto"}, {"kid": 244,"pid": 15,"kota": "Kabupaten Nganjuk"}, {"kid": 245,"pid": 15,"kota": "Kabupaten Ngawi"}, {"kid": 246,"pid": 15,"kota": "Kabupaten Pacitan"}, {"kid": 247,"pid": 15,"kota": "Kabupaten Pamekasan"}, {"kid": 248,"pid": 15,"kota": "Kabupaten Pasuruan"}, {"kid": 249,"pid": 15,"kota": "Kabupaten Ponorogo"}, {"kid": 250,"pid": 15,"kota": "Kabupaten Probolinggo"}, {"kid": 251,"pid": 15,"kota": "Kabupaten Sampang"}, {"kid": 252,"pid": 15,"kota": "Kabupaten Sidoarjo"}, {"kid": 253,"pid": 15,"kota": "Kabupaten Situbondo"}, {"kid": 254,"pid": 15,"kota": "Kabupaten Sumenep"}, {"kid": 255,"pid": 15,"kota": "Kabupaten Trenggalek"}, {"kid": 256,"pid": 15,"kota": "Kabupaten Tuban"}, {"kid": 257,"pid": 15,"kota": "Kabupaten Tulungagung"}, {"kid": 258,"pid": 15,"kota": "Kota Batu"}, {"kid": 259,"pid": 15,"kota": "Kota Blitar"}, {"kid": 260,"pid": 15,"kota": "Kota Kediri"}, {"kid": 261,"pid": 15,"kota": "Kota Madiun"}, {"kid": 262,"pid": 15,"kota": "Kota Malang"}, {"kid": 263,"pid": 15,"kota": "Kota Mojokerto"}, {"kid": 264,"pid": 15,"kota": "Kota Pasuruan"}, {"kid": 265,"pid": 15,"kota": "Kota Probolinggo"}, {"kid": 266,"pid": 15,"kota": "Kota Surabaya"}, {"kid": 267,"pid": 16,"kota": "Kabupaten Bantul"}, {"kid": 268,"pid": 16,"kota": "Kabupaten Gunung Kidul"}, {"kid": 269,"pid": 16,"kota": "Kabupaten Kulon Progo"}, {"kid": 270,"pid": 16,"kota": "Kabupaten Sleman"}, {"kid": 271,"pid": 16,"kota": "Kota Yogyakarta"}, {"kid": 272,"pid": 17,"kota": "Kabupaten Badung"}, {"kid": 273,"pid": 17,"kota": "Kabupaten Bangli"}, {"kid": 274,"pid": 17,"kota": "Kabupaten Buleleng"}, {"kid": 275,"pid": 17,"kota": "Kabupaten Gianyar"}, {"kid": 276,"pid": 17,"kota": "Kabupaten Jembrana"}, {"kid": 277,"pid": 17,"kota": "Kabupaten Karangasem"}, {"kid": 278,"pid": 17,"kota": "Kabupaten Klungkung"}, {"kid": 279,"pid": 17,"kota": "Kabupaten Tabanan"}, {"kid": 280,"pid": 17,"kota": "Kota Denpasar"}, {"kid": 281,"pid": 18,"kota": "Kabupaten Bima"}, {"kid": 282,"pid": 18,"kota": "Kabupaten Dompu"}, {"kid": 283,"pid": 18,"kota": "Kabupaten Lombok Barat"}, {"kid": 284,"pid": 18,"kota": "Kabupaten Lombok Tengah"}, {"kid": 285,"pid": 18,"kota": "Kabupaten Lombok Timur"}, {"kid": 286,"pid": 18,"kota": "Kabupaten Lombok Utara"}, {"kid": 287,"pid": 18,"kota": "Kabupaten Sumbawa"}, {"kid": 288,"pid": 18,"kota": "Kabupaten Sumbawa Barat"}, {"kid": 289,"pid": 18,"kota": "Kota Bima"}, {"kid": 290,"pid": 18,"kota": "Kota Mataram"}, {"kid": 291,"pid": 19,"kota": "Kabupaten Kupang"}, {"kid": 292,"pid": 19,"kota": "Kabupaten Timor Tengah Selatan"}, {"kid": 293,"pid": 19,"kota": "Kabupaten Timor Tengah Utara"}, {"kid": 294,"pid": 19,"kota": "Kabupaten Belu"}, {"kid": 295,"pid": 19,"kota": "Kabupaten Alor"}, {"kid": 296,"pid": 19,"kota": "Kabupaten Flores Timur"}, {"kid": 297,"pid": 19,"kota": "Kabupaten Sikka"}, {"kid": 298,"pid": 19,"kota": "Kabupaten Ende"}, {"kid": 299,"pid": 19,"kota": "Kabupaten Ngada"}, {"kid": 300,"pid": 19,"kota": "Kabupaten Manggarai"}, {"kid": 301,"pid": 19,"kota": "Kabupaten Sumba Timur"}, {"kid": 302,"pid": 19,"kota": "Kabupaten Sumba Barat"}, {"kid": 303,"pid": 19,"kota": "Kabupaten Lembata"}, {"kid": 304,"pid": 19,"kota": "Kabupaten Rote Ndao"}, {"kid": 305,"pid": 19,"kota": "Kabupaten Manggarai Barat"}, {"kid": 306,"pid": 19,"kota": "Kabupaten Nagekeo"}, {"kid": 307,"pid": 19,"kota": "Kabupaten Sumba Tengah"}, {"kid": 308,"pid": 19,"kota": "Kabupaten Sumba Barat Daya"}, {"kid": 309,"pid": 19,"kota": "Kabupaten Manggarai Timur"}, {"kid": 310,"pid": 19,"kota": "Kabupaten Sabu Raijua"}, {"kid": 311,"pid": 19,"kota": "Kota Kupang"}, {"kid": 312,"pid": 20,"kota": "Kabupaten Bengkayang"}, {"kid": 313,"pid": 20,"kota": "Kabupaten Kapuas Hulu"}, {"kid": 314,"pid": 20,"kota": "Kabupaten Kayong Utara"}, {"kid": 315,"pid": 20,"kota": "Kabupaten Ketapang"}, {"kid": 316,"pid": 20,"kota": "Kabupaten Kubu Raya"}, {"kid": 317,"pid": 20,"kota": "Kabupaten Landak"}, {"kid": 318,"pid": 20,"kota": "Kabupaten Melawi"}, {"kid": 319,"pid": 20,"kota": "Kabupaten Pontianak"}, {"kid": 320,"pid": 20,"kota": "Kabupaten Sambas"}, {"kid": 321,"pid": 20,"kota": "Kabupaten Sanggau"}, {"kid": 322,"pid": 20,"kota": "Kabupaten Sekadau"}, {"kid": 323,"pid": 20,"kota": "Kabupaten Sintang"}, {"kid": 324,"pid": 20,"kota": "Kota Pontianak"}, {"kid": 325,"pid": 20,"kota": "Kota Singkawang"}, {"kid": 326,"pid": 21,"kota": "Kabupaten Balangan"}, {"kid": 327,"pid": 21,"kota": "Kabupaten Banjar"}, {"kid": 328,"pid": 21,"kota": "Kabupaten Barito Kuala"}, {"kid": 329,"pid": 21,"kota": "Kabupaten Hulu Sungai Selatan"}, {"kid": 330,"pid": 21,"kota": "Kabupaten Hulu Sungai Tengah"}, {"kid": 331,"pid": 21,"kota": "Kabupaten Hulu Sungai Utara"}, {"kid": 332,"pid": 21,"kota": "Kabupaten Kotabaru"}, {"kid": 333,"pid": 21,"kota": "Kabupaten Tabalong"}, {"kid": 334,"pid": 21,"kota": "Kabupaten Tanah Bumbu"}, {"kid": 335,"pid": 21,"kota": "Kabupaten Tanah Laut"}, {"kid": 336,"pid": 21,"kota": "Kabupaten Tapin"}, {"kid": 337,"pid": 21,"kota": "Kota Banjarbaru"}, {"kid": 338,"pid": 21,"kota": "Kota Banjarmasin"}, {"kid": 339,"pid": 22,"kota": "Kabupaten Barito Selatan"}, {"kid": 340,"pid": 22,"kota": "Kabupaten Barito Timur"}, {"kid": 341,"pid": 22,"kota": "Kabupaten Barito Utara"}, {"kid": 342,"pid": 22,"kota": "Kabupaten Gunung Mas"}, {"kid": 343,"pid": 22,"kota": "Kabupaten Kapuas"}, {"kid": 344,"pid": 22,"kota": "Kabupaten Katingan"}, {"kid": 345,"pid": 22,"kota": "Kabupaten Kotawaringin Barat"}, {"kid": 346,"pid": 22,"kota": "Kabupaten Kotawaringin Timur"}, {"kid": 347,"pid": 22,"kota": "Kabupaten Lamandau"}, {"kid": 348,"pid": 22,"kota": "Kabupaten Murung Raya"}, {"kid": 349,"pid": 22,"kota": "Kabupaten Pulang Pisau"}, {"kid": 350,"pid": 22,"kota": "Kabupaten Sukamara"}, {"kid": 351,"pid": 22,"kota": "Kabupaten Seruyan"}, {"kid": 352,"pid": 22,"kota": "Kota Palangka Raya"}, {"kid": 353,"pid": 23,"kota": "Kabupaten Berau"}, {"kid": 354,"pid": 23,"kota": "Kabupaten Bulungan"}, {"kid": 355,"pid": 23,"kota": "Kabupaten Kutai Barat"}, {"kid": 356,"pid": 23,"kota": "Kabupaten Kutai Kartanegara"}, {"kid": 357,"pid": 23,"kota": "Kabupaten Kutai Timur"}, {"kid": 358,"pid": 23,"kota": "Kabupaten Malinau"}, {"kid": 359,"pid": 23,"kota": "Kabupaten Nunukan"}, {"kid": 360,"pid": 23,"kota": "Kabupaten Paser"}, {"kid": 361,"pid": 23,"kota": "Kabupaten Penajam Paser Utara"}, {"kid": 362,"pid": 23,"kota": "Kabupaten Tana Tidung"}, {"kid": 363,"pid": 23,"kota": "Kota Balikpapan"}, {"kid": 364,"pid": 23,"kota": "Kota Bontang"}, {"kid": 365,"pid": 23,"kota": "Kota Samarinda"}, {"kid": 366,"pid": 23,"kota": "Kota Tarakan"}, {"kid": 367,"pid": 24,"kota": "Kabupaten Boalemo"}, {"kid": 368,"pid": 24,"kota": "Kabupaten Bone Bolango"}, {"kid": 369,"pid": 24,"kota": "Kabupaten Gorontalo"}, {"kid": 370,"pid": 24,"kota": "Kabupaten Gorontalo Utara"}, {"kid": 371,"pid": 24,"kota": "Kabupaten Pohuwato"}, {"kid": 372,"pid": 24,"kota": "Kota Gorontalo"}, {"kid": 373,"pid": 25,"kota": "Kabupaten Bantaeng"}, {"kid": 374,"pid": 25,"kota": "Kabupaten Barru"}, {"kid": 375,"pid": 25,"kota": "Kabupaten Bone"}, {"kid": 376,"pid": 25,"kota": "Kabupaten Bulukumba"}, {"kid": 377,"pid": 25,"kota": "Kabupaten Enrekang"}, {"kid": 378,"pid": 25,"kota": "Kabupaten Gowa"}, {"kid": 379,"pid": 25,"kota": "Kabupaten Jeneponto"}, {"kid": 380,"pid": 25,"kota": "Kabupaten Kepulauan Selayar"}, {"kid": 381,"pid": 25,"kota": "Kabupaten Luwu"}, {"kid": 382,"pid": 25,"kota": "Kabupaten Luwu Timur"}, {"kid": 383,"pid": 25,"kota": "Kabupaten Luwu Utara"}, {"kid": 384,"pid": 25,"kota": "Kabupaten Maros"}, {"kid": 385,"pid": 25,"kota": "Kabupaten Pangkajene dan Kepulauan"}, {"kid": 386,"pid": 25,"kota": "Kabupaten Pinrang"}, {"kid": 387,"pid": 25,"kota": "Kabupaten Sidenreng Rappang"}, {"kid": 388,"pid": 25,"kota": "Kabupaten Sinjai"}, {"kid": 389,"pid": 25,"kota": "Kabupaten Soppeng"}, {"kid": 390,"pid": 25,"kota": "Kabupaten Takalar"}, {"kid": 391,"pid": 25,"kota": "Kabupaten Tana Toraja"}, {"kid": 392,"pid": 25,"kota": "Kabupaten Toraja Utara"}, {"kid": 393,"pid": 25,"kota": "Kabupaten Wajo"}, {"kid": 394,"pid": 25,"kota": "Kota Makassar"}, {"kid": 395,"pid": 25,"kota": "Kota Palopo"}, {"kid": 396,"pid": 25,"kota": "Kota Parepare"}, {"kid": 397,"pid": 26,"kota": "Kabupaten Bombana"}, {"kid": 398,"pid": 26,"kota": "Kabupaten Buton"}, {"kid": 399,"pid": 26,"kota": "Kabupaten Buton Utara"}, {"kid": 400,"pid": 26,"kota": "Kabupaten Kolaka"}, {"kid": 401,"pid": 26,"kota": "Kabupaten Kolaka Utara"}, {"kid": 402,"pid": 26,"kota": "Kabupaten Konawe"}, {"kid": 403,"pid": 26,"kota": "Kabupaten Konawe Selatan"}, {"kid": 404,"pid": 26,"kota": "Kabupaten Konawe Utara"}, {"kid": 405,"pid": 26,"kota": "Kabupaten Muna"}, {"kid": 406,"pid": 26,"kota": "Kabupaten Wakatobi"}, {"kid": 407,"pid": 26,"kota": "Kota Bau-Bau"}, {"kid": 408,"pid": 26,"kota": "Kota Kendari"}, {"kid": 409,"pid": 27,"kota": "Kabupaten Banggai"}, {"kid": 410,"pid": 27,"kota": "Kabupaten Banggai Kepulauan"}, {"kid": 411,"pid": 27,"kota": "Kabupaten Buol"}, {"kid": 412,"pid": 27,"kota": "Kabupaten Donggala"}, {"kid": 413,"pid": 27,"kota": "Kabupaten Morowali"}, {"kid": 414,"pid": 27,"kota": "Kabupaten Parigi Moutong"}, {"kid": 415,"pid": 27,"kota": "Kabupaten Poso"}, {"kid": 416,"pid": 27,"kota": "Kabupaten Tojo Una-Una"}, {"kid": 417,"pid": 27,"kota": "Kabupaten Toli-Toli"}, {"kid": 418,"pid": 27,"kota": "Kabupaten Sigi"}, {"kid": 419,"pid": 27,"kota": "Kota Palu"}, {"kid": 420,"pid": 28,"kota": "Kabupaten Bolaang Mongondow"}, {"kid": 421,"pid": 28,"kota": "Kabupaten Bolaang Mongondow Selatan"}, {"kid": 422,"pid": 28,"kota": "Kabupaten Bolaang Mongondow Timur"}, {"kid": 423,"pid": 28,"kota": "Kabupaten Bolaang Mongondow Utara"}, {"kid": 424,"pid": 28,"kota": "Kabupaten Kepulauan Sangihe"}, {"kid": 425,"pid": 28,"kota": "Kabupaten Kepulauan Siau Tagulandang Biaro"}, {"kid": 426,"pid": 28,"kota": "Kabupaten Kepulauan Talaud"}, {"kid": 427,"pid": 28,"kota": "Kabupaten Minahasa"}, {"kid": 428,"pid": 28,"kota": "Kabupaten Minahasa Selatan"}, {"kid": 429,"pid": 28,"kota": "Kabupaten Minahasa Tenggara"}, {"kid": 430,"pid": 28,"kota": "Kabupaten Minahasa Utara"}, {"kid": 431,"pid": 28,"kota": "Kota Bitung"}, {"kid": 432,"pid": 28,"kota": "Kota Kotamobagu"}, {"kid": 433,"pid": 28,"kota": "Kota Manado"}, {"kid": 434,"pid": 28,"kota": "Kota Tomohon"}, {"kid": 435,"pid": 29,"kota": "Kabupaten Majene"}, {"kid": 436,"pid": 29,"kota": "Kabupaten Mamasa"}, {"kid": 437,"pid": 29,"kota": "Kabupaten Mamuju"}, {"kid": 438,"pid": 29,"kota": "Kabupaten Mamuju Utara"}, {"kid": 439,"pid": 29,"kota": "Kabupaten Polewali Mandar"}, {"kid": 440,"pid": 30,"kota": "Kabupaten Buru"}, {"kid": 441,"pid": 30,"kota": "Kabupaten Buru Selatan"}, {"kid": 442,"pid": 30,"kota": "Kabupaten Kepulauan Aru"}, {"kid": 443,"pid": 30,"kota": "Kabupaten Maluku Barat Daya"}, {"kid": 444,"pid": 30,"kota": "Kabupaten Maluku Tengah"}, {"kid": 445,"pid": 30,"kota": "Kabupaten Maluku Tenggara"}, {"kid": 446,"pid": 30,"kota": "Kabupaten Maluku Tenggara Barat"}, {"kid": 447,"pid": 30,"kota": "Kabupaten Seram Bagian Barat"}, {"kid": 448,"pid": 30,"kota": "Kabupaten Seram Bagian Timur"}, {"kid": 449,"pid": 30,"kota": "Kota Ambon"}, {"kid": 450,"pid": 30,"kota": "Kota Tual"}, {"kid": 451,"pid": 31,"kota": "Kabupaten Halmahera Barat"}, {"kid": 452,"pid": 31,"kota": "Kabupaten Halmahera Tengah"}, {"kid": 453,"pid": 31,"kota": "Kabupaten Halmahera Utara"}, {"kid": 454,"pid": 31,"kota": "Kabupaten Halmahera Selatan"}, {"kid": 455,"pid": 31,"kota": "Kabupaten Kepulauan Sula"}, {"kid": 456,"pid": 31,"kota": "Kabupaten Halmahera Timur"}, {"kid": 457,"pid": 31,"kota": "Kabupaten Pulau Morotai"}, {"kid": 458,"pid": 31,"kota": "Kota Ternate"}, {"kid": 459,"pid": 31,"kota": "Kota Tidore Kepulauan"}, {"kid": 460,"pid": 32,"kota": "Kabupaten Asmat"}, {"kid": 461,"pid": 32,"kota": "Kabupaten Biak Numfor"}, {"kid": 462,"pid": 32,"kota": "Kabupaten Boven Digoel"}, {"kid": 463,"pid": 32,"kota": "Kabupaten Deiyai"}, {"kid": 464,"pid": 32,"kota": "Kabupaten Dogiyai"}, {"kid": 465,"pid": 32,"kota": "Kabupaten Intan Jaya"}, {"kid": 466,"pid": 32,"kota": "Kabupaten Jayapura"}, {"kid": 467,"pid": 32,"kota": "Kabupaten Jayawijaya"}, {"kid": 468,"pid": 32,"kota": "Kabupaten Keerom"}, {"kid": 469,"pid": 32,"kota": "Kabupaten Kepulauan Yapen"}, {"kid": 470,"pid": 32,"kota": "Kabupaten Lanny Jaya"}, {"kid": 471,"pid": 32,"kota": "Kabupaten Mamberamo Raya"}, {"kid": 472,"pid": 32,"kota": "Kabupaten Mamberamo Tengah"}, {"kid": 473,"pid": 32,"kota": "Kabupaten Mappi"}, {"kid": 474,"pid": 32,"kota": "Kabupaten Merauke"}, {"kid": 475,"pid": 32,"kota": "Kabupaten Mimika"}, {"kid": 476,"pid": 32,"kota": "Kabupaten Nabire"}, {"kid": 477,"pid": 32,"kota": "Kabupaten Nduga"}, {"kid": 478,"pid": 32,"kota": "Kabupaten Paniai"}, {"kid": 479,"pid": 32,"kota": "Kabupaten Pegunungan Bintang"}, {"kid": 480,"pid": 32,"kota": "Kabupaten Puncak"}, {"kid": 481,"pid": 32,"kota": "Kabupaten Puncak Jaya"}, {"kid": 482,"pid": 32,"kota": "Kabupaten Sarmi"}, {"kid": 483,"pid": 32,"kota": "Kabupaten Supiori"}, {"kid": 484,"pid": 32,"kota": "Kabupaten Tolikara"}, {"kid": 485,"pid": 32,"kota": "Kabupaten Waropen"}, {"kid": 486,"pid": 32,"kota": "Kabupaten Yahukimo"}, {"kid": 487,"pid": 32,"kota": "Kabupaten Yalimo"}, {"kid": 488,"pid": 32,"kota": "Kota Jayapura"}, {"kid": 489,"pid": 33,"kota": "Kabupaten Fakfak"}, {"kid": 490,"pid": 33,"kota": "Kabupaten Kaimana"}, {"kid": 491,"pid": 33,"kota": "Kabupaten Manokwari"}, {"kid": 492,"pid": 33,"kota": "Kabupaten Maybrat"}, {"kid": 493,"pid": 33,"kota": "Kabupaten Raja Ampat"}, {"kid": 494,"pid": 33,"kota": "Kabupaten Sorong"}, {"kid": 495,"pid": 33,"kota": "Kabupaten Sorong Selatan"}, {"kid": 496,"pid": 33,"kota": "Kabupaten Tambrauw"}, {"kid": 497,"pid": 33,"kota": "Kabupaten Teluk Bintuni"}, {"kid": 498,"pid": 33,"kota": "Kabupaten Teluk Wondama"}, {"kid": 499,"pid": 33,"kota": "Kota Sorong"}]';
        var jsonProvinsi = '[{"pid": 1,"provinsi": "Aceh","prov": "Aceh"}, {"pid": 2,"provinsi": "Sumatera Utara","prov": "Sumut"}, {"pid": 3,"provinsi": "Bengkulu","prov": "Bengkulu"}, {"pid": 4,"provinsi": "Jambi","prov": "Jambi"}, {"pid": 5,"provinsi": "Riau","prov": "Riau"}, {"pid": 6,"provinsi": "Sumatera Barat","prov": "Sumbar"}, {"pid": 7,"provinsi": "Sumatera Selatan","prov": "Sumsel"}, {"pid": 8,"provinsi": "Lampung","prov": "Lampung"}, {"pid": 9,"provinsi": "Kepulauan Bangka Belitung","prov": "Babel"}, {"pid": 10,"provinsi": "Kepulauan Riau","prov": "Kepri"}, {"pid": 11,"provinsi": "Banten","prov": "Banten"}, {"pid": 12,"provinsi": "Jawa Barat","prov": "Jabar"}, {"pid": 13,"provinsi": "DKI Jakarta","prov": "DKI"}, {"pid": 14,"provinsi": "Jawa Tengah","prov": "Jateng"}, {"pid": 15,"provinsi": "Jawa Timur","prov": "Jatim"}, {"pid": 16,"provinsi": "Daerah Istimewa Yogyakarta","prov": "DIY"}, {"pid": 17,"provinsi": "Bali","prov": "Bali"}, {"pid": 18,"provinsi": "Nusa Tenggara Barat","prov": "NTB"}, {"pid": 19,"provinsi": "Nusa Tenggara Timur","prov": "NTT"}, {"pid": 20,"provinsi": "Kalimantan Barat","prov": "Kalbar"}, {"pid": 21,"provinsi": "Kalimantan Selatan","prov": "Kalsel"}, {"pid": 22,"provinsi": "Kalimantan Tengah","prov": "Kalteng"}, {"pid": 23,"provinsi": "Kalimantan Timur","prov": "Kaltim"}, {"pid": 24,"provinsi": "Gorontalo","prov": "Gorontalo"}, {"pid": 25,"provinsi": "Sulawesi Selatan","prov": "Sulsel"}, {"pid": 26,"provinsi": "Sulawesi Tenggara","prov": "Sultra"}, {"pid": 27,"provinsi": "Sulawesi Tengah","prov": "Sulteng"}, {"pid": 28,"provinsi": "Sulawesi Utara","prov": "Sulut"}, {"pid": 29,"provinsi": "Sulawesi Barat","prov": "Sulbar"}, {"pid": 30,"provinsi": "Maluku","prov": "Maluku"}, {"pid": 31,"provinsi": "Maluku Utara","prov": "Malut"}, {"pid": 32,"provinsi": "Papua","prov": "Papua"}, {"pid": 33,"provinsi": "Papua Barat","prov": "Papbar"}]';
        var jsonNegara = '[{"nid": 1,"negara": "Afghanistan"}, {"nid": 2,"negara": "Albania"}, {"nid": 3,"negara": "Algeria"}, {"nid": 4,"negara": "American Samoa"}, {"nid": 5,"negara": "Andorra"}, {"nid": 6,"negara": "Angola"}, {"nid": 7,"negara": "Anguilla"}, {"nid": 8,"negara": "Antarctica"}, {"nid": 9,"negara": "Antigua and Barbuda"}, {"nid": 10,"negara": "Argentina"}, {"nid": 11,"negara": "Armenia"}, {"nid": 12,"negara": "Armenia"}, {"nid": 13,"negara": "Aruba"}, {"nid": 14,"negara": "Australia"}, {"nid": 15,"negara": "Austria"}, {"nid": 16,"negara": "Azerbaijan"}, {"nid": 17,"negara": "Azerbaijan"}, {"nid": 18,"negara": "Bahamas"}, {"nid": 19,"negara": "Bahrain"}, {"nid": 20,"negara": "Bangladesh"}, {"nid": 21,"negara": "Barbados"}, {"nid": 22,"negara": "Belarus"}, {"nid": 23,"negara": "Belgium"}, {"nid": 24,"negara": "Belize"}, {"nid": 25,"negara": "Benin"}, {"nid": 26,"negara": "Bermuda"}, {"nid": 27,"negara": "Bhutan"}, {"nid": 28,"negara": "Bolivia"}, {"nid": 29,"negara": "Bosnia and Herzegovina"}, {"nid": 30,"negara": "Botswana"}, {"nid": 31,"negara": "Bouvet Island"}, {"nid": 32,"negara": "Brazil"}, {"nid": 33,"negara": "British Indian Ocean Territory"}, {"nid": 34,"negara": "Brunei Darussalam"}, {"nid": 35,"negara": "Bulgaria"}, {"nid": 36,"negara": "Burkina Faso"}, {"nid": 37,"negara": "Burundi"}, {"nid": 38,"negara": "Cambodia"}, {"nid": 39,"negara": "Cameroon"}, {"nid": 40,"negara": "Canada"}, {"nid": 41,"negara": "Cape Verde"}, {"nid": 42,"negara": "Cayman Islands"}, {"nid": 43,"negara": "Central African Republic"}, {"nid": 44,"negara": "Chad"}, {"nid": 45,"negara": "Chile"}, {"nid": 46,"negara": "China"}, {"nid": 47,"negara": "Christmas Island"}, {"nid": 48,"negara": "Cocos (Keeling) Islands"}, {"nid": 49,"negara": "Colombia"}, {"nid": 50,"negara": "Comoros"}, {"nid": 51,"negara": "Congo"}, {"nid": 52,"negara": "Congo, The Democratic Republic of The"}, {"nid": 53,"negara": "Cook Islands"}, {"nid": 54,"negara": "Costa Rica"}, {"nid": 55,"negara": "Cote D\'ivoire"}, {"nid": 56,"negara": "Croatia"}, {"nid": 57,"negara": "Cuba"}, {"nid": 58,"negara": "Cyprus"}, {"nid": 59,"negara": "Czech Republic"}, {"nid": 60,"negara": "Denmark"}, {"nid": 61,"negara": "Djibouti"}, {"nid": 62,"negara": "Dominica"}, {"nid": 63,"negara": "Dominican Republic"}, {"nid": 64,"negara": "Easter Island"}, {"nid": 65,"negara": "Ecuador"}, {"nid": 66,"negara": "Egypt"}, {"nid": 67,"negara": "El Salvador"}, {"nid": 68,"negara": "Equatorial Guinea"}, {"nid": 69,"negara": "Eritrea"}, {"nid": 70,"negara": "Estonia"}, {"nid": 71,"negara": "Ethiopia"}, {"nid": 72,"negara": "Falkland Islands (Malvinas)"}, {"nid": 73,"negara": "Faroe Islands"}, {"nid": 74,"negara": "Fiji"}, {"nid": 75,"negara": "Finland"}, {"nid": 76,"negara": "France"}, {"nid": 77,"negara": "French Guiana"}, {"nid": 78,"negara": "French Polynesia"}, {"nid": 79,"negara": "French Southern Territories"}, {"nid": 80,"negara": "Gabon"}, {"nid": 81,"negara": "Gambia"}, {"nid": 82,"negara": "Georgia"}, {"nid": 83,"negara": "Germany"}, {"nid": 84,"negara": "Ghana"}, {"nid": 85,"negara": "Gibraltar"}, {"nid": 86,"negara": "Greece"}, {"nid": 87,"negara": "Greenland"}, {"nid": 88,"negara": "Grenada"}, {"nid": 89,"negara": "Guadeloupe"}, {"nid": 90,"negara": "Guam"}, {"nid": 91,"negara": "Guatemala"}, {"nid": 92,"negara": "Guinea"}, {"nid": 93,"negara": "Guinea-bissau"}, {"nid": 94,"negara": "Guyana"}, {"nid": 95,"negara": "Haiti"}, {"nid": 96,"negara": "Heard Island and Mcdonald Islands"}, {"nid": 97,"negara": "Honduras"}, {"nid": 98,"negara": "Hong Kong"}, {"nid": 99,"negara": "Hungary"}, {"nid": 100,"negara": "Iceland"}, {"nid": 101,"negara": "India"}, {"nid": 102,"negara": "Indonesia"}, {"nid": 103,"negara": "Iran"}, {"nid": 104,"negara": "Iraq"}, {"nid": 105,"negara": "Ireland"}, {"nid": 106,"negara": "Israel"}, {"nid": 107,"negara": "Italy"}, {"nid": 108,"negara": "Jamaica"}, {"nid": 109,"negara": "Japan"}, {"nid": 110,"negara": "Jordan"}, {"nid": 111,"negara": "Kazakhstan"}, {"nid": 112,"negara": "Kazakhstan"}, {"nid": 113,"negara": "Kenya"}, {"nid": 114,"negara": "Kiribati"}, {"nid": 115,"negara": "Korea, North"}, {"nid": 116,"negara": "Korea, South"}, {"nid": 117,"negara": "Kosovo"}, {"nid": 118,"negara": "Kuwait"}, {"nid": 119,"negara": "Kyrgyzstan"}, {"nid": 120,"negara": "Laos"}, {"nid": 121,"negara": "Latvia"}, {"nid": 122,"negara": "Lebanon"}, {"nid": 123,"negara": "Lesotho"}, {"nid": 124,"negara": "Liberia"}, {"nid": 125,"negara": "Libyan Arab Jamahiriya"}, {"nid": 126,"negara": "Liechtenstein"}, {"nid": 127,"negara": "Lithuania"}, {"nid": 128,"negara": "Luxembourg"}, {"nid": 129,"negara": "Macau"}, {"nid": 130,"negara": "Macedonia"}, {"nid": 131,"negara": "Madagascar"}, {"nid": 132,"negara": "Malawi"}, {"nid": 133,"negara": "Malaysia"}, {"nid": 134,"negara": "Maldives"}, {"nid": 135,"negara": "Mali"}, {"nid": 136,"negara": "Malta"}, {"nid": 137,"negara": "Marshall Islands"}, {"nid": 138,"negara": "Martinique"}, {"nid": 139,"negara": "Mauritania"}, {"nid": 140,"negara": "Mauritius"}, {"nid": 141,"negara": "Mayotte"}, {"nid": 142,"negara": "Mexico"}, {"nid": 143,"negara": "Micronesia, Federated States of"}, {"nid": 144,"negara": "Moldova, Republic of"}, {"nid": 145,"negara": "Monaco"}, {"nid": 146,"negara": "Mongolia"}, {"nid": 147,"negara": "Montenegro"}, {"nid": 148,"negara": "Montserrat"}, {"nid": 149,"negara": "Morocco"}, {"nid": 150,"negara": "Mozambique"}, {"nid": 151,"negara": "Myanmar"}, {"nid": 152,"negara": "Namibia"}, {"nid": 153,"negara": "Nauru"}, {"nid": 154,"negara": "Nepal"}, {"nid": 155,"negara": "Netherlands"}, {"nid": 156,"negara": "Netherlands Antilles"}, {"nid": 157,"negara": "New Caledonia"}, {"nid": 158,"negara": "New Zealand"}, {"nid": 159,"negara": "Nicaragua"}, {"nid": 160,"negara": "Niger"}, {"nid": 161,"negara": "Nigeria"}, {"nid": 162,"negara": "Niue"}, {"nid": 163,"negara": "Norfolk Island"}, {"nid": 164,"negara": "Northern Mariana Islands"}, {"nid": 165,"negara": "Norway"}, {"nid": 166,"negara": "Oman"}, {"nid": 167,"negara": "Pakistan"}, {"nid": 168,"negara": "Palau"}, {"nid": 169,"negara": "Palestinian Territory"}, {"nid": 170,"negara": "Panama"}, {"nid": 171,"negara": "Papua New Guinea"}, {"nid": 172,"negara": "Paraguay"}, {"nid": 173,"negara": "Peru"}, {"nid": 174,"negara": "Philippines"}, {"nid": 175,"negara": "Pitcairn"}, {"nid": 176,"negara": "Poland"}, {"nid": 177,"negara": "Portugal"}, {"nid": 178,"negara": "Puerto Rico"}, {"nid": 179,"negara": "Qatar"}, {"nid": 180,"negara": "Reunion"}, {"nid": 181,"negara": "Romania"}, {"nid": 182,"negara": "Russia"}, {"nid": 183,"negara": "Russia"}, {"nid": 184,"negara": "Rwanda"}, {"nid": 185,"negara": "Saint Helena"}, {"nid": 186,"negara": "Saint Kitts and Nevis"}, {"nid": 187,"negara": "Saint Lucia"}, {"nid": 188,"negara": "Saint Pierre and Miquelon"}, {"nid": 189,"negara": "Saint Vincent and The Grenadines"}, {"nid": 190,"negara": "Samoa"}, {"nid": 191,"negara": "San Marino"}, {"nid": 192,"negara": "Sao Tome and Principe"}, {"nid": 193,"negara": "Saudi Arabia"}, {"nid": 194,"negara": "Senegal"}, {"nid": 195,"negara": "Serbia and Montenegro"}, {"nid": 196,"negara": "Seychelles"}, {"nid": 197,"negara": "Sierra Leone"}, {"nid": 198,"negara": "Singapore"}, {"nid": 199,"negara": "Slovakia"}, {"nid": 200,"negara": "Slovenia"}, {"nid": 201,"negara": "Solomon Islands"}, {"nid": 202,"negara": "Somalia"}, {"nid": 203,"negara": "South Africa"}, {"nid": 204,"negara": "South Georgia and The South Sandwich Islands"}, {"nid": 205,"negara": "Spain"}, {"nid": 206,"negara": "Sri Lanka"}, {"nid": 207,"negara": "Sudan"}, {"nid": 208,"negara": "Suriname"}, {"nid": 209,"negara": "Svalbard and Jan Mayen"}, {"nid": 210,"negara": "Swaziland"}, {"nid": 211,"negara": "Sweden"}, {"nid": 212,"negara": "Switzerland"}, {"nid": 213,"negara": "Syria"}, {"nid": 214,"negara": "Taiwan"}, {"nid": 215,"negara": "Tajikistan"}, {"nid": 216,"negara": "Tanzania, United Republic of"}, {"nid": 217,"negara": "Thailand"}, {"nid": 218,"negara": "Timor-leste"}, {"nid": 219,"negara": "Togo"}, {"nid": 220,"negara": "Tokelau"}, {"nid": 221,"negara": "Tonga"}, {"nid": 222,"negara": "Trinidad and Tobago"}, {"nid": 223,"negara": "Tunisia"}, {"nid": 224,"negara": "Turkey"}, {"nid": 225,"negara": "Turkey"}, {"nid": 226,"negara": "Turkmenistan"}, {"nid": 227,"negara": "Turks and Caicos Islands"}, {"nid": 228,"negara": "Tuvalu"}, {"nid": 229,"negara": "Uganda"}, {"nid": 230,"negara": "Ukraine"}, {"nid": 231,"negara": "United Arab Emirates"}, {"nid": 232,"negara": "United Kingdom"}, {"nid": 233,"negara": "United States"}, {"nid": 234,"negara": "United States Minor Outlying Islands"}, {"nid": 235,"negara": "Uruguay"}, {"nid": 236,"negara": "Uzbekistan"}, {"nid": 237,"negara": "Vanuatu"}, {"nid": 238,"negara": "Vatican City"}, {"nid": 239,"negara": "Venezuela"}, {"nid": 240,"negara": "Vietnam"}, {"nid": 241,"negara": "Virgin Islands, British"}, {"nid": 242,"negara": "Virgin Islands, U.S."}, {"nid": 243,"negara": "Wallis and Futuna"}, {"nid": 244,"negara": "Western Sahara"}, {"nid": 245,"negara": "Yemen"}, {"nid": 246,"negara": "Yemen"}, {"nid": 247,"negara": "Zambia"}, {"nid": 248,"negara": "Zimbabwe"}]';
        var jsonObj = $.parseJSON(jsonKota);
        var sourceArr = [];

        for (var i=0; i<jsonObj.length; i++) {
          sourceArr.push(jsonObj[i].label);
        }

        $("#kota").typeahead({
            source : sourceArr
        });
});

$(function(){
  $('legend').click(function(){
   $(this).siblings().slideToggle("slow");
  });
});