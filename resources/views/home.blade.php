@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Image & push') }}</div>

                <div class="card-body">
                    <form method="post" action="{{route('image.upload')}}" enctype="multipart/form-data" 
                  class="dropzone" id="dropzone">
                        @csrf
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response) 
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
};
</script>
@endsection
