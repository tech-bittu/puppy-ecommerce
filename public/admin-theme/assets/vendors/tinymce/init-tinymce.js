tinymce.init({
	/* replace textarea having class .tinymce with tinymce editor */
	selector: ".tinymce",

	/* theme of the editor */
	theme: "modern",
	skin: "lightgray",

	/* width and height of the editor */
	width: "100%",
	height: 300,

	// // menubar: 'custom',
	// menu: {
	// 	custom: { title: 'Custom menu', items: 'basicitem nesteditem toggleitem' }
	// },

	/* display statusbar */
	statubar: true,
	/* plugin */
	plugins: [
		"advlist autolink link lists charmap print preview hr anchor pagebreak autosave wordcount",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		'image imagetools',
		"save table contextmenu directionality emoticons template paste textcolor",
		"template",
	],
	imagetools_cors_hosts: ['http://localhost/', 'otherdomain.com'],
	imagetools_credentials_hosts: ['http://localhost/', 'otherdomain.com'],
	imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",

	/* toolbar */
	toolbar: "insertfile undo redo | template | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image  rotateleft rotateright  flipv fliph  editimage  | code | print preview media fullpage | forecolor backcolor | fullscreen",
	image_title: true,
	file_picker_types: 'image',
	/* and here's our custom image picker*/
	file_picker_callback: (cb, value, meta) => {
		const input = document.createElement('input');
		input.setAttribute('type', 'file');
		input.setAttribute('accept', 'image/*');

		input.addEventListener('change', (e) => {
			const file = e.target.files[0];

			const reader = new FileReader();
			reader.addEventListener('load', () => {
				/*
				  Note: Now we need to register the blob in TinyMCEs image blob
				  registry. In the next release this part hopefully won't be
				  necessary, as we are looking to handle it internally.
				*/
				const id = 'blobid' + (new Date()).getTime();
				const blobCache = tinymce.activeEditor.editorUpload.blobCache;
				const base64 = reader.result.split(',')[1];
				const blobInfo = blobCache.create(id, file, base64);
				blobCache.add(blobInfo);

				/* call the callback and populate the Title field with the file name */
				cb(blobInfo.blobUri(), { title: file.name });
			});
			reader.readAsDataURL(file);
		});

		input.click();
	},

	content_style: `body { font-family:'Open Sans', serif; font-size:16px }`,
	/* style */
	style_formats: [
		{
			title: "Headers", items: [
				{ title: "Header 1", format: "h1" },
				{ title: "Header 2", format: "h2" },
				{ title: "Header 3", format: "h3" },
				{ title: "Header 4", format: "h4" },
				{ title: "Header 5", format: "h5" },
				{ title: "Header 6", format: "h6" }
			]
		},
		{
			title: "Inline", items: [
				{ title: "Bold", icon: "bold", format: "bold" },
				{ title: "Italic", icon: "italic", format: "italic" },
				{ title: "Underline", icon: "underline", format: "underline" },
				{ title: "Strikethrough", icon: "strikethrough", format: "strikethrough" },
				{ title: "Superscript", icon: "superscript", format: "superscript" },
				{ title: "Subscript", icon: "subscript", format: "subscript" },
				{ title: "Code", icon: "code", format: "code" }
			]
		},
		{
			title: "Blocks", items: [
				{ title: "Paragraph", format: "p" },
				{ title: "Blockquote", format: "blockquote" },
				{ title: "Div", format: "div" },
				{ title: "Pre", format: "pre" }
			]
		},
		{
			title: "Alignment", items: [
				{ title: "Left", icon: "alignleft", format: "alignleft" },
				{ title: "Center", icon: "aligncenter", format: "aligncenter" },
				{ title: "Right", icon: "alignright", format: "alignright" },
				{ title: "Justify", icon: "alignjustify", format: "alignjustify" }
			]
		}
	],
	templates: [
		{
			title: 'Article : TOC',
			description: 'Article stand for :  exam, course, college, university, institute, Hospital and clinic only.',
			content: `<div class="toc">
			<h6>Table of Contents Heading</h6>
			<ol class="s2-14-r">
				<li> List name
					<ol type="a">
						<li>sub list name</li>
						<li>sub list name</li>
					</ol>
				</li>
				<li>list name</li>
			</ol>
		</div>`
		},
		{
			title: 'Article : Heading & Para',
			description: 'Article stand for :  exam, course, college, university, institute, Hospital and clinic only.',
			content: `<h6> Heading here</h6>
			<p class=" s2-14-r">
				Paragraph text here
			</p>`
		},
		{
			title: 'Article : Heading & Para & unorder list',
			description: 'Article stand for :  exam, course, college, university, institute, Hospital and clinic only.',
			content: `<h6> Heading here </h6>
			<p class=" s2-14-r">
				Paragraph text here
			</p>
			<ul>
				<li>unorder list</li>
				<li>unorder list</li>
			</ul>`
		},
		{
			title: 'Article : Heading, Para & Table',
			description: 'Article stand for : exam, course, college, university, institute, Hospital and clinic only.',
			content: `<h6> Heading here </h6>
			<p class=" s2-14-r">
				Paragraph text here
			</p>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped s2-14-r mt-4" align="center" style="width:90%;">
					<tbody>
						<tr>
							<td>R1 C1</td>
							<td>R1 C2</td>
						</tr>
						<tr>
							<td>R2 C1</td>
							<td>R2 C2</td>
						</tr>
					</tbody>
				</table>
			</div>`
		},
		{
			title: 'Certificate : heading + image + imageCredit',
			description: 'Only for certificate course lesson',
			content: `<h2 class="course-heading-topic"> Physical Changes </h2>
			<img src="https://medicaljagat.com/assets/img/heretohelp.png" alt="">
			<p class="img-credit c12-r text-center">img credit src: https:/domain.com/urlpath</p>`
		},
		{
			title: 'Certificate : subheading + topicheading + para + unorder list',
			description: 'Only for certificate course lesson',
			content: ` <h3 class="course-subtopic">Sub heading</h3>
			<p class="running-text-heading">running-text heading</p> <p class="running-text">Running text</p>
                <ul class="running-text">
                          <li>list name</li>
                </ul>`
		},
		{
			title: 'Certificate : subheading + topicheading + para',
			description: 'Only for certificate course lesson',
			content: `<h3 class="course-subtopic">Sub heading</h3>
			<p class="running-text-heading">running-text heading</p>
			<p class="running-text">Running text</p>`
		},
		{
			title: 'Certificate : Keynote',
			description: 'Only for certificate course lesson',
			content: `<div class="keynote"><p class="keynote-heading">Keynote heading</p><p class="running-text">keynote text</p></div>`
		}
		// Add extra templates here
	]

});
