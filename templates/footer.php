<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script  async defer src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=AIzaSyDn9y73GPMnv45sooYfKhpOMHCGZZg4H_4" ></script>
<script>
    $('#map-modal').on('shown.bs.modal', function (event) {
        let btn = $(event.relatedTarget);
        let address = btn.text();

        $('.modal-title').text(address);
            
        let gMap= new GMap2(document.getElementById("map"));
        let geocoder = new GClientGeocoder();

        const callback = pointer => {
            if(!pointer){
                    alert("Not found");
                }
                else{
                    let gPointer = new GMarker(pointer);
                    gMap.setCenter(pointer,12);
                    gMap.addOverlay(gPointer);
                    gPointer.openInfoWindowHtml(address);
                }
        };

        geocoder.getLatLng(address, callback);
    });
</script>
</body>
</html>