import { mount } from '@vue/test-utils';
import Slickcarouselreviews from './SlickCarouselReviews';

describe('Spec Slickcarouselreviews', function() {
    it('mounts', () => {
        const wrapper = mount(Slickcarouselreviews);
        expect(wrapper)
            .toBeTruthy();
    });
});
