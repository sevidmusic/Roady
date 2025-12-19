/**
 * Copy inner text of element whose id matches
 * specified elementId
 *
 * Example:
 *
 * ```
 * <p id="element-id">Hello World</p>
 * <button onclick="myFunction('element-id')">Copy text</button>
 * ```
 */
function copyInnerTextToClipboard(elementId) {
  // Get the text field
  var copyText = document.getElementById(elementId);

  // Select the text field
  var text = copyText.innerText;

  // Copy the text inside the text field
  navigator.clipboard.writeText(text);

  // Alert the copied text
  alert("Copied to clipboard 😎");
  console.log("Copied the text: " + text);
}
