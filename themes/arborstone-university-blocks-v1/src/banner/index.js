import apiFetch from "@wordpress/api-fetch"
import { Button, PanelBody, PanelRow } from "@wordpress/components"
import { InnerBlocks, InspectorControls, MediaUpload, MediaUploadCheck, useBlockProps } from "@wordpress/block-editor"
import { registerBlockType } from "@wordpress/blocks"
import { useEffect } from "@wordpress/element"

import metadata from "./block.json"

function Edit(props) {
  
  useEffect(() => {
    if(!props.attributes.imgURL) props.setAttributes({imgURL: `${themeData.path}/images/office.webp`})
  }, [])

  useEffect(() => {
    props.setAttributes({testAttr: 'testAttr'});
    if (props.attributes.imgID) {
      async function go() {
        const response = await apiFetch({
          path: `/wp/v2/media/${props.attributes.imgID}`,
          method: "GET"
        })
        props.setAttributes({ imgURL: response.media_details.sizes.full.source_url })
      }
      go()
    }
  },[props.attributes.imgID])
  
  const blockProps = useBlockProps()

  function onFileSelect(x) {
    props.setAttributes({ imgID: x.id })
  }

  return <div {...blockProps}>
    <InspectorControls>
      <PanelBody title="Background" initialOpen={true}>
        <PanelRow>
          <MediaUploadCheck>
            <MediaUpload
              onSelect={onFileSelect}
              value={props.attributes.imgID}
              render={({ open }) => {
                return <Button onClick={open}>Choose Image</Button>
              }}
            />
          </MediaUploadCheck>
        </PanelRow>
      </PanelBody>
    </InspectorControls>
    <div className="page-banner">
      <div className="page-banner__bg-image" style={{ backgroundImage: `url('${props.attributes.imgURL}')` }}></div>
      <div className="page-banner__content">
        <InnerBlocks allowedBlocks={["arborstone/genericheading", "arborstone/genericbutton"]} />
      </div>
    </div>
  </div>
}

registerBlockType(metadata.name, {
  edit: Edit,
  save: () => <InnerBlocks.Content />
})