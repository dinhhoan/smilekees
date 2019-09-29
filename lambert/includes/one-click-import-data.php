<?php
//http://proteusthemes.github.io/one-click-demo-import/
//https://wordpress.org/plugins/one-click-demo-import/

function lambert_import_files() {
  return array(
    array(
      'import_file_name'             => esc_html__('Full Demo Content (widgets included)','lambert' ),
      'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/demo_data_files/lambert-all.xml',
      'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/demo_data_files/lambert.wie',
      'import_notice'                => esc_html__( 'Lambert Theme - Full Demo Content (widgets included).', 'lambert' ),
    ),

    

  );
}



add_filter( 'pt-ocdi/import_files', 'lambert_import_files' );