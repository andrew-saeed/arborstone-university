import apiFetch from "@wordpress/api-fetch"
import { Button, PanelBody, PanelRow } from "@wordpress/components"
import {
  useBlockProps,
  InnerBlocks,
  InspectorControls,
  MediaUpload,
  MediaUploadCheck
} from "@wordpress/block-editor"
import { registerBlockType } from "@wordpress/blocks"
import { useEffect } from "@wordpress/element"

import metadata from "./block.json"

function Edit(props) {
  const blockProps = useBlockProps()

  useEffect(function () {
    console.log(props.attributes.themeimage, props.attributes.imgURL)
    if (props.attributes.themeimage) {
      props.setAttributes({
        imgURL: `${themeData.path}/images/${props.attributes.themeimage}`
      })
    }
    if (!props.attributes.themeimage && !props.attributes.imgURL) {
      props.setAttributes({ imgURL: `${themeData.path}/images/office.webp` })
    }
  }, [])

  useEffect(
    function () {
      if (props.attributes.imgID) {
        async function go() {
          const response = await apiFetch({
            path: `/wp/v2/media/${props.attributes.imgID}`,
            method: "GET"
          })
          props.setAttributes({
            themeimage: "",
            imgURL: response.media_details.sizes.full.source_url
          })
        }
        go()
      }
    },
    [props.attributes.imgID]
  )

  function onFileSelect(x) {
    props.setAttributes({ imgID: x.id })
  }

  return <>
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
    <div {...blockProps} style={{ backgroundImage: `url('${props.attributes.imgURL}')` }}>
      <InnerBlocks allowedBlocks={['arborstone/genericheading', 'arborstone/genericbutton']} />
    </div>
  </>
}

registerBlockType(metadata.name, {
  edit: Edit,
  save: function() {
    return <InnerBlocks.Content />
  }
})