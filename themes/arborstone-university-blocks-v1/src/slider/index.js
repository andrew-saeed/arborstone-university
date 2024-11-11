import { registerBlockType } from "@wordpress/blocks"
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor"
import metadata from "./block.json"

function Edit() {
  const blockProps = useBlockProps()

  return <div {...blockProps}>
    <InnerBlocks allowedBlocks={["arborstone/slide"]} />
  </div>
}

registerBlockType(metadata.name, {
  edit: Edit,
  save: function() {
    return <InnerBlocks.Content />
  }
})