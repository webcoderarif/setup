 (function($) {

    $.fn.extend({
        
        jClocksGMT: function( options ) 
        {
            // plugin default options
            var defaults = 
            {
                title: 'Greenwich, England',
                offset: '0',
                dst: true,
                digital: true,
                analog: false,
                timeformat: 'hh:mm:ss A',
                date: false,
                dateformat: 'MM/DD/YYYY',
                angleSec: 0,
                angleMin: 0,
                angleHour: 0,
                skin: 1,
                imgpath: ''
            }
            
            // merge user options with defaults
            var options = $.extend(defaults, options);
            
            return this.each(function()
            {
                // set offset variable per instance
                var offset = parseFloat(options.offset);
                // get id of element
                var id = $(this).attr('id');

                // add class to main element
                $(this).addClass('jcgmt-container');

                // create label
                $("<div />", { text: options.title, class: "jcgmt-lbl  info-box2" }).appendTo("#" + id);

                if( options.analog )
                {
                    // create clock container
                    $("<div />", { class: "jcgmt-clockHolder" }).appendTo("#" + id);
                    // create hour hand
                    $("<div />", { class: "jcgmt-rotatingWrapper" }).append($("<img />", { class: "jcgmt-hour", src: options.imgpath + "images/jcgmt-" + options.skin + "-clock_hour.png" })).appendTo("#" + id + ' .jcgmt-clockHolder');
                    // create min hand
                    $("<div />", { class: "jcgmt-rotatingWrapper" }).append($("<img />", { class: "jcgmt-min", src: options.imgpath + "images/jcgmt-" + options.skin + "-clock_min.png" })).appendTo("#" + id + ' .jcgmt-clockHolder');
                    // create sec hand
                    $("<div />", { class: "jcgmt-rotatingWrapper" }).append($("<img />", { class: "jcgmt-sec", src: options.imgpath + "images/jcgmt-" + options.skin + "-clock_sec.png" })).appendTo("#" + id + ' .jcgmt-clockHolder');
                    // create clock face
                    $("<img />", { class: "jcgmt-clock", src: options.imgpath + 'images/jcgmt-' + options.skin + '-clock_face.png' }).appendTo("#" + id + ' .jcgmt-clockHolder');
                }

                // create digital clock container
                $("<div />", { class: "jcgmt-digital  info-box2" }).appendTo("#" + id);

                //create date container
               // $("<div />", { class: "jcgmt-date" }).appendTo("#" + id);
                
                // initial hand rotation
                $('#' + id + ' .jcgmt-sec').rotate( options.angleSec );
                $('#' + id + ' .jcgmt-min').rotate( options.angleMin );
                $('#' + id + ' .jcgmt-hour').rotate( options.angleHour );

                // get timezone by gmt offset
                Date.prototype.getTimezoneByOffset = function( offset, y, m, d ) 
                {
                    var date = new Date; // get date

                    if( y ) // if has date params
                    {
                        date = new Date( y, m, d ); // get date with params
                    }
                    
                    var utc = date.getTime() + ( date.getTimezoneOffset() * 60000 ); // get local offset

                    var dateGMT = new Date( utc + ( 3600000 * offset ) ); // get requested offset based on local

                    return dateGMT;
                }

                // check if daylight saving time is in effect
                Date.prototype.stdTimezoneOffset = function() 
                {
                    var jan = this.getTimezoneByOffset( offset, this.getFullYear(), 0, 1 );

                    var jul = this.getTimezoneByOffset( offset, this.getFullYear(), 6, 1 );

                    return Math.max( jan.getTimezoneOffset(), jul.getTimezoneOffset() );
                }

                // checkes if DST is in effect
                Date.prototype.isDST = function() 
                {
                    var date = this.getTimezoneByOffset(offset);

                    return date.getTimezoneOffset() < this.stdTimezoneOffset();
                }

                // date formatter
                Date.prototype.format = function( format )
                {
                    var D = "Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(","),
                        M = "January,February,March,April,May,June,July,August,September,October,November,December".split(",");

                    var self = this;
                    return format.replace(/a|A|Z|S(SS)?|ss?|mm?|HH?|hh?|D{1,4}|M{1,4}|YY(YY)?|'([^']|'')*'/g, function(str) {
                      var c1 = str.charAt(0),
                          ret = str.charAt(0) == "'"
                          ? (c1=0) || str.slice(1, -1).replace(/''/g, "'")
                          : str == "a"
                            ? (self.getHours() < 12 ? "am" : "pm")
                            : str == "A"
                              ? (self.getHours() < 12 ? "AM" : "PM")
                              : str == "Z"
                                ? (("+" + -self.getTimezoneOffset() / 60).replace(/^\D?(\D)/, "$1").replace(/^(.)(.)$/, "$10$2") + "00")
                                : c1 == "S"
                                  ? self.getMilliseconds()
                                  : c1 == "s"
                                    ? self.getSeconds()
                                    : c1 == "H"
                                      ? self.getHours()
                                      : c1 == "h"
                                        ? (self.getHours() % 12) || 12
                                        : (c1 == "D" && str.length > 2)
                                          ? D[self.getDay()].slice(0, str.length > 3 ? 9 : 3)
                                          : c1 == "D"
                                            ? self.getDate()
                                            : (c1 == "M" && str.length > 2)
                                              ? M[self.getMonth()].slice(0, str.length > 3 ? 9 : 3)
                                              : c1 == "m"
                                                ? self.getMinutes()
                                                : c1 == "M"
                                                  ? self.getMonth() + 1
                                                  : ("" + self.getFullYear()).slice(-str.length);
                      return c1 && str.length < 4 && ("" + ret).length < str.length
                        ? ("00" + ret).slice(-str.length)
                        : ret;
                    });
                  }
                
                // create new date object
                var dateCheck = new Date().getTimezoneByOffset( offset );

                // check for DST
                if( options.dst && dateCheck.isDST() ) 
                {
                   offset = offset + 1;
                }

                // clock interval
                setInterval(function () 
                {
                    // create new date object
                    var nd = new Date().getTimezoneByOffset( offset ); 
                    
                    // time string variable
                    var timeStr = nd.format( options.timeformat );
                    
                    // update analog clock if enabled
                    if( options.analog ) 
                    {
                        // rotate second hand
                        $('#' + id + ' .jcgmt-sec').rotate( nd.getSeconds() * 6 );
                        // rotate minute hand
                        $('#' + id + ' .jcgmt-min').rotate( nd.getMinutes() * 6 ) ;
                        // rotate hour hand
                        $('#' + id + ' .jcgmt-hour').rotate( ( nd.getHours() * 5 + nd.getMinutes() / 12 ) * 6 );

                        // update title for tooltip
                        $('#' + id + ' .jcgmt-clockHolder').attr( 'title', timeStr );
                    }
                    
                    // update digital clock if enabled
                    if( options.digital ) 
                    {
                        $('#' + id + ' .jcgmt-digital').html( timeStr );
                        $('#' + id + ' .jcgmt-digital').attr( 'title', timeStr );
                    }

                    // update date if enabled
                    if( options.date ) 
                    {
                        var dateStamp = nd.format( options.dateformat );
                        $('#' + id + ' .jcgmt-date').html( dateStamp );
                        $('#' + id + ' .jcgmt-date').attr( 'title', dateStamp );
                    }

                }, 1000);

            });

        }

    });

})(jQuery);
