from moviepy.editor import *
from PIL import Image
import numpy as np


Strip = 5

MIN_MATCH = 4
NUM_SAMPLE = 20
RADIUS = 1.0

left_template = []
right_template = []

video = None
processed_frames = None


class InputError(Exception):
    pass


def rgb2gray(rgb_array):
    height, width, dim = rgb_array.shape

    if dim == 1:
        return rgb_array

    elif dim == 3:
        gray_array = np.zeros((height, width), dtype=np.uint8)
        for i in xrange(height):
            for j in xrange(width):
                gray_array[i][j] = 0.2126 * rgb_array[i][j][0] \
                                 + 0.7152 * rgb_array[i][j][1] \
                                 + 0.0722 * rgb_array[i][j][2]

        return gray_array

    else:
        raise InputError("Input should be RGB color image")


def initTemplate(frame):

    height, width, dim = frame.shape
    if dim == 3:
        frame = rgb2gray(frame)
        im = Image.fromarray(frame)
        im.save("frame.png")

    left_p, right_p = setPostion(width)

    left_blank = frame[:, (left_p-Strip):(left_p+Strip)]
    right_blank = frame[:, (right_p-Strip):(right_p+Strip)]

    assert(left_blank.shape == (height, Strip*2))

    left_template.append(left_blank)
    right_template.append(right_blank)


def setPostion(width):

    left_p = int(width / 3)
    right_p = int(2 * left_p)

    return left_p, right_p


def matchPixel(pixel_val, template, x, y):

    cnt_b = 0
    cnt_f = 0
    while (cnt_b < MIN_MATCH and cnt_f < NUM_SAMPLE):
        v = template[cnt_f][y][x]
        if (abs(v - pixel_val)).all() < RADIUS:
            cnt_b = cnt_b + 1
        cnt_f = cnt_f + 1

    if cnt_b >= MIN_MATCH:
        return 0
    else:
        return 1


def matchTemplate(frame):
    height, width, _ = frame.shape

    left_p, right_p = setPostion(width)

    left_mask = np.zeros(left_template[0].shape, dtype=np.uint8)
    right_mask = np.zeros(right_template[0].shape, dtype=np.uint8)

    for i in xrange(Strip*2):
        for j in xrange(height):
            left_val = frame[j][left_p+i]
            right_val = frame[j][right_p+i]
            left_mask[j][i] = matchPixel(left_val, left_template, i, j)
            right_mask[j][i] = matchPixel(right_val, right_template, i, j)

#    kernel = np.ones((3, 3), np.uint8)
#    left_mask = cv2.erode(left_mask, kernel, iterations=1)
    return left_mask, right_mask


def addPrevious(frame):
    height, width, _ = frame.shape
    left_p = int(width / 3)
    right_p = int(2 * left_p)

    for i in xrange(height):
        for j in xrange(left_p-Strip, left_p+Strip):
            frame[i][j] = np.array([255, 255, 255])
        for j in xrange(right_p-Strip, right_p+Strip):
            frame[i][j] = np.array([255, 255, 255])

#    im = Image.fromarray(frame)
#    im.save("frame.png")
    return frame


def addAfter(frame, left_mask, right_mask):
    height, width, _ = frame.shape
    left_p = int(width / 3)
    right_p = int(2 * left_p)

    for i in xrange(height):
        for j in xrange(left_p-Strip, left_p+Strip):
            if left_mask[i][j-left_p] == 0:
                frame[i][j] = np.array([255, 255, 255])

        for j in xrange(right_p-Strip, right_p+Strip):
            if right_mask[i][j-right_p] == 0:
                frame[i][j] = np.array([255, 255, 255])

    return frame


def make_frame(t):
    global processed_frames
    return processed_frames[int(t*8)]


def main(args):
    init_video = VideoFileClip(args[1])
    global video
    video = init_video.set_fps(8)

    # for comparison
    video.write_gif(args[2], fps=8)

    #print "video duration : ", video.duration
    #print "video fps : ", video.fps

    global processed_frames
    processed_frames = []

    cnt = 0
    for frame in video.iter_frames():

        if cnt < NUM_SAMPLE:
            initTemplate(frame)
            frame = addPrevious(frame)
            processed_frames.append(frame)
            #print "update model"
            cnt = cnt + 1

        else:
            #print "processing"
            left_mask, right_mask = matchTemplate(frame)

            frame = addAfter(frame, left_mask, right_mask)
            processed_frames.append(frame)
            cnt = cnt + 1

    clip = VideoClip(make_frame, duration=video.duration)
    clip.write_gif(args[3], fps=8)


if __name__ == "__main__":
    import sys
    main(sys.argv)
