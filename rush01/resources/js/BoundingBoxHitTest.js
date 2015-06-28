BoundingBoxHitTest = {
  /* Mixin class to override _getObjectsUnderPoint with a more efficient method of only
   * checking the bounding box of the children that have extended the BoundingBox mixin class.
   * This does not offer pixel-precision but more like a html/css style approach, which is sufficient for our needs.
   * This should be replaced by canvas's addHitRegion API when support arrives for it, since it improves accessibility.
   * NB! does not modify children so all childrens' _getObjectsUnderPoint methods are still the old one.
   */
  _getObjectsUnderPoint: function(x, y, arr, mouseEvents, self) {
    /* mouseEvents parameter is ignored
     * if arr is given, it is populated by all the the inner-most children that are under the point (x,y)
     * otherwise, only the front-most child is returned.
     * NB! If a child extends BoundingBox and matches, its children are not checked for a match
     */
    var bb, child, match, result, i;
    if (!self) {
      self = this;
    }
    for (i = this.children.length-1; i >=0; i--) {
      child = this.children[i];
      bb = child._bounding_box;
      if (bb && child.visible) {
        match = (child.x + bb.x <= x && x < child.x + bb.x + bb.width) && (child.y + bb.y <= y && y < child.y + bb.y + bb.height);
        if (match) {
          if (arr) {
            arr.push(child);
            continue;
          } else {
            return child;
          }
        }
      }
      if (child instanceof createjs.Container && child.visible && !bb) {
        result = self._getObjectsUnderPoint.call(child, x - child.x - child.regX, y - child.y - child.regY, arr, mouseEvents, self);
        if (result) {
          if (arr) {
            arr.push(result);
            continue;
          } else {
            return result;
          }
        }
      }
    }
    return null;
  }
};

BoundingBox = {
  /* The mixin class that all DisplayObjects should extend if they want to emit Mouse Events
   * The bounding box is defined relative to the object itself and must be updated manually as needed.
   */
  _bounding_box: null,
  setBoundingBox: function(x, y, w, h) {
    return this._bounding_box = new createjs.Rectangle(x, y, w, h);
  }
};
