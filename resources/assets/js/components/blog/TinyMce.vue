<template>
	<div>
		<textarea
			rows="10"
			id="tinymce"
			:value="value">
		</textarea>
	</div>
</template>
<script>
import tinymce from 'tinymce'
import theme from 'tinymce/themes/modern/theme.js'
import textcolor from 'tinymce/plugins/textcolor/index.js'
import image from 'tinymce/plugins/image/index.js'
import link from 'tinymce/plugins/link/index.js'
import paste from 'tinymce/plugins/paste/index.js'
import lists from 'tinymce/plugins/lists/index.js'

	export default {
		props: [
			'content',
		],

		data() {
			return {
				value: '',
				baseURL: '',
				id: {
					type: String,
					default: 'editor'
				}
			}
		},

		created() {
			this.value = this.content
		},

		mounted() {
			tinymce.baseURL = this.baseURL
			tinymce.init({
				selector: '#tinymce',
				plugins: 'textcolor link image paste lists',
				menubar: false,
				toolbar: 'undo redo | forecolor backcolor | styleselect | fontselect | bullist numlist | outdent indent | cut copy paste | link image',
				paste_data_images: true,
				image_title: true, 
				// enable automatic uploads of images represented by blob or data URIs
				automatic_uploads: true,
				  	// URL of our upload handler (for more details check: https://	www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
				  	// images_upload_url: 'postAcceptor.php',
				  	// here we add custom filepicker only to Image dialog
				file_picker_types: 'image', 
				  	// and here's our custom image picker
			  	file_picker_callback: function(cb, value, meta) {
			    	var input = document.createElement('input');
			    	input.setAttribute('type', 'file');
			    	input.setAttribute('accept', 'image/*');
				    
				    // Note: In modern browsers input[type="file"] is functional without 
				    // even adding it to the DOM, but that might not be the case in some older
				    // or quirky browsers like IE, so you might want to add it to the DOM
				    // just in case, and visually hide it. And do not forget do remove it
				    // once you do not need it anymore.
				    input.onchange = function() {
				      	var file = this.files[0];
				      
				      	var reader = new FileReader();
				      	reader.onload = function () {
				        	// Note: Now we need to register the blob in TinyMCEs image blob
				        	// registry. In the next release this part hopefully won't be
				        	// necessary, as we are looking to handle it internally.
				        	var id = 'blobid' + (new Date()).getTime();
				        	var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
				        	var base64 = reader.result.split(',')[1];
				        	var blobInfo = blobCache.create(id, file, base64);
				        	blobCache.add(blobInfo);

				        	// call the callback and populate the Title field with the file name
				        	cb(blobInfo.blobUri(), { title: file.name });
				      	};
				      	reader.readAsDataURL(file);
				    };
				    
				    input.click();
				},

				init_instance_callback: (editor) => {
      				editor.on('KeyUp', (e) => {
        			this.$emit('input', editor.getContent());
      			});

      			editor.on('Change', (e) => {
        			this.$emit('input', editor.getContent());
      			});
      			if(this.value){
      				editor.setContent(this.value);
      			}
    			},
  			})
		},
  		destroyed () {
    		tinymce.get(this.id).destroy();
  		}
	}
</script>